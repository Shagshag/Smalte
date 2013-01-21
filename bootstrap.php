<?php

/*
 * (c) Smalte - 2012 ~ Until the end of the world...
 *
 * Julien Breux <julien@smalte.org>
 * Fabien Serny <fabien@smalte.org>
 * Grégoire Poulain <gregoire@smalte.org>
 * Alain Folletete <alain@smalte.org>
 * Raphaël Malié <raphael@smalte.org>
 *
 * Thanks a lot to our community!
 *
 * Read LICENSE.md file for more information.
 */

// ===== SECTION: Debug =====
function p($a){echo '<xmp>';print_r($a);echo '</xmp>';}
function d($a){p($a);exit;}



// ===== SECTION: Auto-load =====
require_once __DIR__.'/libraries/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(include __DIR__.'/data/cache/loader/namespaces.php');
$loader->registerPrefixes(include __DIR__.'/data/cache/loader/prefixes.php');
$loader->register();

// @todo quick fix for swift to move
require dirname(__FILE__).'/libraries/Swift/swift_required.php';


// ===== SECTION: Configuration =====
use Smalte\Utils\ArrayUtils;
use Smalte\Environment\Factory;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpFoundation\Request;

// Create request and get current client IP
$request = Request::createFromGlobals();
$clientIp = $request->getClientIp() ?: '0.0.0.0';

// Get main configuration file
$configuration = Yaml::parse(file_get_contents(__DIR__.'/data/config/config.yml'));

// Check all environments and return current environment
$environmentConfiguration = Yaml::parse(file_get_contents(__DIR__.'/data/config/environments.yml'));
$currentEnvironment = Factory::getCurrentEnvironment($environmentConfiguration, $clientIp, $_ENV, $_COOKIE);

if ($currentEnvironment)
{
	// Test if environment file exist
	$environmentConfigurationFile = __DIR__.'/data/config/config.'.$currentEnvironment->getName().'.yml';
	if (file_exists($environmentConfigurationFile))
	{
		// Get environment configuration file and merge with main configuration
		$configurationEnvironment = Yaml::parse(file_get_contents($environmentConfigurationFile));
		if ($configurationEnvironment)
		{
			$configuration = ArrayUtils::merge($configuration, $configurationEnvironment);
		}
	}
}

// ===== SECTION: Dependency Injection Container =====
use Smalte\DependencyInjection\ContainerFactory;

$servicesConfigDirectory = __DIR__.'/data/config/';

$useCache = ($currentEnvironment->getName() === 'prod');
$container = ContainerFactory::create($servicesConfigDirectory, $configuration, $useCache);

// ===== SECTION: ORM =====

$em = $container->get('entityManager');



// ===== SECTION: Router =====
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Smalte\Routing\Loader\Main;
use Smalte\Controller\ControllerResolver;

if (!defined('INSTALL'))
{
	// Get repositories
	try
	{
		$applications	= $em->getRepository('Entities\Application');
		$languages		= $em->getRepository('Entities\Language');
		$routes			= $em->getRepository('Entities\Route');
	}
	catch (Exception $exception)
	{
		exit('Please goto <a href="install.php">Install / Upgrade</a>.');
	}

	// Set router options
	$options = array(
		//'cache_dir' => realpath(__DIR__.'/../../../data/cache/routing/'),
		'matcher_cache_class'	=> 'Matcher',
		'generator_cache_class'	=> 'Generator',
	);

	// Create request and context
	$request = $container->get('request');
	$context = new RequestContext();
	$context->fromRequest($request);

	// Get main language
	$mainLanguage = $languages->findOneBy(array('isMain' => 1));

	// Redirect to translation
	$currentPath = ltrim($request->getPathInfo(), '/');
	$currentPrefix = substr($currentPath, 0, strpos($currentPath, '/'));
	$currentPrefix = $currentPrefix ? $currentPrefix : '';

	$currentApplication = $applications->getByPrefix($currentPrefix);
	$currentApplication = $currentApplication === NULL ? $applications->getDefault() : $currentApplication;

	// Create router and main loader
	$loader = new Main($applications, $languages, $mainLanguage->getId());
	$router = new Router($loader, $routes, $options, $context);

	// Get matcher and generator, ho yeah!!
	$matcher = $router->getMatcher();
	$generator = $router->getGenerator();

	try
	{
		$parameters = $matcher->match($request->getPathInfo());
	}
	catch (Exception $exception)
	{
		$parameters = array(
			'_locale'		=> 'en',
			'_route'		=> 'error404',
			'_application'	=> $currentApplication,
			'_controller'	=> 'Error',
			'_action'		=> 'display404',
		);
	}

	// ===== SECTION: Controller Resolver =====

	$resolver = new ControllerResolver($parameters, $container);
	$response = $resolver->getResponse();
	$response->send();

}
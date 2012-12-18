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
$container = ContainerFactory::create($servicesConfigDirectory, $useCache);


// ===== SECTION: ORM =====
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Common\Cache\ArrayCache;

$config = Setup::createConfiguration(
	true,
	null,
	new ArrayCache()
);
$config->setMetadataDriverImpl(new Smalte\ORM\Parser\YamlDriver(__DIR__.'/data/doctrine/schemas/'));

$em = EntityManager::create(array(
    'driver'	=> $configuration['database']['master']['driver'],
	'host'		=> $configuration['database']['master']['host'],
    'user'		=> $configuration['database']['master']['user'],
    'password'	=> $configuration['database']['master']['password'],
    'dbname'	=> $configuration['database']['master']['dbname'],
), $config);

$em->getMetadataFactory()->setReflectionService(new Smalte\ORM\Parser\AccessibleRuntimeReflectionService());

foreach (new DirectoryIterator(__DIR__.'/libraries/smalte/orm/helpers') as $file)
{
	if ($file->isFile())
	{
		$helperName = $file->getBasename('.php');
		Smalte\ORM\HelperFactory::registerHelper($helperName, "\\Smalte\\ORM\\Helpers\\{$helperName}");
	}
}



// ===== SECTION: Router =====
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Smalte\Routing\Loader\Main;

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

	// Homepage ? Goto translated homepage
	if ($request->getPathInfo() === '/')
	{
		// @todo : Util redirect
		$redirect = new RedirectResponse($request->getBaseUrl().$mainLanguage->getId().'/');
		$redirect->send();
	}

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
			'_application'	=> 'FrontOffice',
			'_controller'	=> 'Error',
			'_action'		=> 'display404',
		);
	}

	// Just use $parameters...
}
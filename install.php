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
 * Read LICENCE file for more information.
 */

/*
 * Additional note:
 * This file is just used during alpha development
 */

define('INSTALL', true);

require __DIR__.'/bootstrap.php';

// ===== SECTION: Router =====
// Add application schema
$compiler = new Smalte\ORM\Parser\YamlCompiler('Entities\\Application');
$compiler->addFile(__DIR__.'/entities/schemas/Application.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

// Add language schema
$compiler = new Smalte\ORM\Parser\YamlCompiler('Entities\\Language');
$compiler->addFile(__DIR__.'/entities/schemas/Language.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

// Add route schema
$compiler = new Smalte\ORM\Parser\YamlCompiler('Entities\\Route');
$compiler->addFile(__DIR__.'/entities/schemas/Route.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

// Dump schema in database
use Doctrine\ORM\Tools\SchemaTool;
$schema = new SchemaTool($em);
$classes = array(
	$em->getClassMetadata('Entities\Application'),
	$em->getClassMetadata('Entities\Language'),
	$em->getClassMetadata('Entities\Route'),
);
try
{
	$schema->createSchema($classes);
}
catch (Exception $exception)
{
	$schema->updateSchema($classes, true);
}

// Truncate "languages" table
$truncate = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('languages');
$em->getConnection()->executeUpdate($truncate);

// Truncate "routes" table
$truncate = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('routes');
$em->getConnection()->executeUpdate($truncate);

// Truncate "applications" table
$truncate = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('applications');
$em->getConnection()->executeUpdate($truncate);

// Add application data
$applications = array(
	array(
		'name'		=> 'FrontOffice',
		'prefix'	=> '',
		'default'	=> true,
	),
	array(
		'name'		=> 'BackOffice',
		'prefix'	=> 'admin',
		'default'	=> false,
	),
);
foreach ($applications AS $applicationData)
{
	$route = new \Entities\Application();
	foreach ($applicationData as $field => $value)
	{
		$method = 'set'.strtoupper(strtolower($field));
		$route->$method($value);
	}
	$em->persist($route);
}
$em->flush();
$em->clear();

// Add language data
$languages = array(
	array(
		'id'	=> 'en',
		'name'	=> 'English',
	),
	array(
		'id'	=> 'fr',
		'name'	=> 'French',
	),
);
foreach ($languages AS $languageData)
{
	$route = new \Entities\Language();
	foreach ($languageData as $field => $value)
	{
		$method = 'set'.strtoupper(strtolower($field));
		$route->$method($value);
	}
	$em->persist($route);
}
$em->flush();
$em->clear();

// Add route data
$routes = array(
	array(
		'name'			=> 'foHome',
		'pattern'		=> '/',
		'module'		=> NULL,
		'application'	=> 'FrontOffice',
		'controller'	=> 'Home',
		'action'		=> 'display',
		'requirements'	=> NULL,
	),
	array(
		'name'			=> 'foLogin',
		'pattern'		=> '/login',
		'module'		=> NULL,
		'application'	=> 'FrontOffice',
		'controller'	=> 'Login',
		'action'		=> 'display',
		'requirements'	=> NULL,
	),
	array(
		'name'			=> 'boHome',
		'pattern'		=> '/',
		'module'		=> NULL,
		'application'	=> 'BackOffice',
		'controller'	=> 'Home',
		'action'		=> 'display',
		'requirements'	=> NULL,
	),
	array(
		'name'			=> 'boLogin',
		'pattern'		=> '/login',
		'module'		=> NULL,
		'application'	=> 'BackOffice',
		'controller'	=> 'Login',
		'action'		=> 'display',
		'requirements'	=> NULL,
	),
	array(
		'name'			=> 'moSmalteSampleHello',
		'pattern'		=> '/hello',
		'module'		=> 'Smalte\Sample',
		'application'	=> 'FrontOffice',
		'controller'	=> 'Hello',
		'action'		=> 'display',
		'requirements'	=> NULL,
	),
	array(
		'name'			=> 'moSmalteSampleComplex',
		'pattern'		=> '/complex/{year}/{number}',
		'module'		=> 'Smalte\Sample',
		'application'	=> 'FrontOffice',
		'controller'	=> 'Complex',
		'action'		=> 'display',
		'requirements'	=> '{"year":"[0-9]{4}","number":"\\\d"}',
	),
);
foreach ($routes AS $routeData)
{
	$route = new \Entities\Route();
	foreach ($routeData as $field => $value)
	{
		if ($field == 'application')
		{
			$application = $em->getRepository('Entities\Application')->findOneBy(array('name' => $value));
			$route->setApplication($application);
		}
		else
		{
			$method = 'set'.strtoupper(strtolower($field));
			$route->$method($value);
		}
	}
	$em->persist($route);
}
$em->flush();
$em->clear();
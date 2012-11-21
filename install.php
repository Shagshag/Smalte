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

echo '- Create Entities\\Application schema'.PHP_EOL;

// Add language schema
$compiler = new Smalte\ORM\Parser\YamlCompiler('Entities\\Language');
$compiler->addFile(__DIR__.'/entities/schemas/Language.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

echo '- Create Entities\\Language schema'.PHP_EOL;

// Add route schema
$compiler = new Smalte\ORM\Parser\YamlCompiler('Entities\\Route');
$compiler->addFile(__DIR__.'/entities/schemas/Route.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

echo '- Create Entities\\Route schema'.PHP_EOL;

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

echo '- Dump schema to database'.PHP_EOL;

// Truncate "languages" table
$truncate = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('languages');
$em->getConnection()->executeUpdate($truncate);

echo '- Truncate "languages" table'.PHP_EOL;

// Truncate "routes" table
$truncate = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('routes');
$em->getConnection()->executeUpdate($truncate);

echo '- Truncate "routes" table'.PHP_EOL;

// Truncate "applications" table
$truncate = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('applications');
$em->getConnection()->executeUpdate($truncate);

echo '- Truncate "applications" table'.PHP_EOL;

// Add application data
$applications = array(
	array(
		'name'		=> 'FrontOffice',
		'prefix'	=> '',
	),
	array(
		'name'		=> 'BackOffice',
		'prefix'	=> 'admin',

	),
);
foreach ($applications AS $applicationData)
{
	$application = new \Entities\Application();
	foreach ($applicationData as $field => $value)
	{
		$method = 'set'.ucfirst(strtolower($field));
		$application->$method($value);
	}
	$em->persist($application);

	echo '- Create application "'.$applicationData['name'].'"'.PHP_EOL;
}
$em->flush();
$em->clear();

// Add language data
$languages = array(
	array(
		'id'	=> 'en',
		'name'	=> 'English',
		'main'	=> true,
	),
	array(
		'id'	=> 'fr',
		'name'	=> 'French',
		'main'	=> false,
	),
);
foreach ($languages AS $languageData)
{
	$language = new \Entities\Language();
	foreach ($languageData as $field => $value)
	{
		$method = 'set'.ucfirst(strtolower($field));
		$language->$method($value);
	}
	$em->persist($language);

	echo '- Create language "'.$languageData['name'].'"'.PHP_EOL;
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
			$method = 'set'.ucfirst(strtolower($field));
			$route->$method($value);
		}
	}
	$em->persist($route);

	echo '- Create route "'.$routeData['name'].'"'.PHP_EOL;
}
$em->flush();
$em->clear();
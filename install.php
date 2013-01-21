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

/*
 * Additional note:
 * This file is just used during alpha development
 */

define('INSTALL', true);

require __DIR__.'/bootstrap.php';

define('EOL', '<br />'.PHP_EOL);

// Dump schema in database
$queries = explode(';', file_get_contents(__DIR__.'/db_schema.sql'));
$database = $container->get('database');
$database->exec('SET foreign_key_checks = 0');
foreach ($queries as $query)
{
	$query = trim($query);
	if ($query)
	{
		$database->exec($query);
	}
}

echo '- Dump schema to database'.EOL;

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
	$application->setDateCreated(new \DateTime());
	$em->insert($application);

	echo '- Create application "'.$applicationData['name'].'"'.EOL;
}

// Add language data
$languages = array(
	array(
		'id'		=> 'en',
		'name'		=> 'English',
		'isMain'	=> true,
	),
	array(
		'id'		=> 'fr',
		'name'		=> 'French',
		'isMain'	=> false,
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
	$language->setDateCreated(new \DateTime());
	$em->insert($language);

	echo '- Create language "'.$languageData['name'].'"'.EOL;
}

// Add route data
$routes = array(
	array(
		'name'			=> 'foHome',
		'pattern'		=> '/',
		'module'		=> NULL,
		'application'	=> 'FrontOffice',
		'controller'	=> 'Home',
		'action'		=> 'index',
		'requirements'	=> NULL,
		'methods'		=> 'GET',
	),
	array(
		'name'			=> 'foLogin',
		'pattern'		=> '/login',
		'module'		=> NULL,
		'application'	=> 'FrontOffice',
		'controller'	=> 'Login',
		'action'		=> 'index',
		'requirements'	=> NULL,
		'methods'		=> 'GET',
	),
	array(
		'name'			=> 'boHome',
		'pattern'		=> '/',
		'module'		=> NULL,
		'application'	=> 'BackOffice',
		'controller'	=> 'Home',
		'action'		=> 'index',
		'requirements'	=> NULL,
		'methods'		=> 'GET',
	),
	array(
		'name'			=> 'boLogin',
		'pattern'		=> '/login',
		'module'		=> NULL,
		'application'	=> 'BackOffice',
		'controller'	=> 'Login',
		'action'		=> 'index',
		'requirements'	=> NULL,
		'methods'		=> 'GET',
	),
	array(
		'name'			=> 'moSmalteSampleHello',
		'pattern'		=> '/hello',
		'module'		=> 'Smalte\Sample',
		'application'	=> 'FrontOffice',
		'controller'	=> 'Hello',
		'action'		=> 'display',
		'requirements'	=> NULL,
		'methods'		=> 'GET',
	),
	array(
		'name'			=> 'moSmalteSampleComplex',
		'pattern'		=> '/complex/{year}/{number}',
		'module'		=> 'Smalte\Sample',
		'application'	=> 'FrontOffice',
		'controller'	=> 'Complex',
		'action'		=> 'display',
		'requirements'	=> '{"year":"[0-9]{4}","number":"\\\d"}',
		'methods'		=> 'GET',
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
	$route->setDateCreated(new \DateTime());
	$em->insert($route);

	echo '- Create route "'.$routeData['name'].'"'.EOL;
}
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
 
// SECTION: Debug
function p($a){echo '<xmp>';print_r($a);echo '</xmp>';}
function d($a){p($a);exit;}



// SECTION: Auto-load
require_once __DIR__.'/libraries/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(include __DIR__.'/data/cache/loader/namespaces.php');
$loader->registerPrefixes(include __DIR__.'/data/cache/loader/prefixes.php');
$loader->register();



// SECTION: ORM
use Doctrine\ORM\EntityManager,
	Doctrine\ORM\Tools\Setup,
	Doctrine\Common\Cache\ArrayCache;

$compiler = new Smalte\ORM\Parser\YamlCompiler('Entities\\User');
$compiler->addFile(__DIR__.'/entities/schemas/User.yml');
$compiler->addFile(__DIR__.'/modules/smalte/sample/entities/extends/schemas/User.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

$compiler = new Smalte\ORM\Parser\YamlCompiler('Modules\\Smalte\\Sample\\Entities\\Topic');
$compiler->addFile(__DIR__.'/modules/smalte/sample/entities/schemas/Topic.yml');
$compiler->write(__DIR__.'/data/doctrine/schemas/');

$config = Setup::createConfiguration(
	true,
	null,
	new ArrayCache()
);
$config->setMetadataDriverImpl(new Smalte\ORM\Parser\YamlDriver(__DIR__.'/data/doctrine/schemas/'));

$em = EntityManager::create(array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'smalte',
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

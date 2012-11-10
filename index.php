<?php

/*
 * (c) Smalte - 2012 ~ Until the end of the world...
 *
 * Julien Breux <julien@smalte.org>
 * Fabien Serny <fabien@smalte.org>
 * GrÃ©goire Poulain <gregoire@smalte.org>
 * Alain Folletete <alain@smalte.org>
 * Raphaël Malié <raphael@smalte.org>
 *
 * Thanks a lot to our community!
 *
 * Read LICENCE file for more information.
 */

require dirname(__FILE__).'/bootstrap.php';

$em->getRepository('\Entities\User')->doSomething();
$em->getRepository('\Modules\Smalte\Sample\Entities\Topic')->doSomething();

$user = new Entities\User();
$user->name = 'Moustache';
$user->testHelpers();
$em->persist($user);
<?php

/*
 *	(c) Smalte - 2012 ~ Until the end of the world...
 *
 *	Julien Breux <julien@smalte.org>
 *	Fabien Serny <fabien@smalte.org>
 *	Grégoire Poulain <gregoire@smalte.org>
 *	Alain Folletete <alain@smalte.org>
 *	Raphaël Malié <raphael@smalte.org>
 *
 *	Thanks a lot to our community!
 *
 *	Read LICENCE file for more information.
 */

// Define root path
define('PATH_ROOT', dirname(__FILE__));

// Use composer bootstrap (PSR-0 compliant)
$loader = require_once PATH_ROOT.'/libraries/autoload.php';

// Controller namespace
$loader->add('controllers', PATH_ROOT);
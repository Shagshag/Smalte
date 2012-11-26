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

namespace Controllers\FrontOffice;

use \Smalte\Controller\Controller;

class Home extends Controller
{
	public function displayAction()
	{
		$vars = array(
			'test' => 'mycontent',
			'date' => date('H:i:s'),
		);
		$content = $this->renderView('home/index', $vars);
		return $this->getResponse($content);
	}
}


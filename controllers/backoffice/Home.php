<?php

/*
 * (c) Smalte - 2013 ~ Until the end of the world...
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

namespace Controllers\BackOffice;

use \Smalte\Controller\Controller;

class Home extends Controller
{
	public function indexAction()
	{
		// Set template vars
		$templateVars = array(
			'name' => 'John Doe',
		);

		$this->setTemplateVars($templateVars);
	}
}


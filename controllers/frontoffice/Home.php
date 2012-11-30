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
		// Set template vars like this
		$this->templateVars = array(
			'test' => 'mycontent',
			'date' => date('H:i:s'),
		);

		// Controller resolver will automatically render the template corresponding to this method (home/display)

		// You can change template with this method
		// $this->setTemplate('home/index');

		// In case of json answer (for example)
		// You can avoid template rendering with this method
		// $this->noRender();

		// You will be able to set the Json content with this method
		// $this->setResponseContent(json_encode(array('Smalte', 'is', 'good')));
	}
}


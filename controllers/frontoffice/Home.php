<?php

/*
 * (c) Smalte - 2013 ~ Until the end of the world...
 *
 * Thanks a lot to our community!
 *
 * @link http://smalte.org Official website
 * @link http://github.com/Smalte/Smalte For the source repository
 * @license Read LICENSE.md file for more information.
 */

namespace Controllers\FrontOffice;

use \Smalte\Controller\Controller;

class Home extends Controller
{
	public function indexAction()
	{
		// Set template vars like this
		$templateVars = array(
			'test' => 'mycontent',
			'date' => date('H:i:s'),
		);

		$this->setTemplateVars($templateVars);

		// Controller resolver will automatically render the template corresponding to this method (home/display)

		// You can change template with this method
		// $this->setTemplate('home/index');

		// In case of json answer (for example)
		// You can avoid template rendering with this method
		// $this->setFlagRender(self::NORENDER);

		// You will be able to set the Json content with this method
		// $this->setResponseContent(json_encode(array('Smalte', 'is', 'good')));
	}
}


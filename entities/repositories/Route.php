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

namespace Entities\Repositories;

use Smalte\ORM\Work\Repository;

class Route extends Repository
{
	/**
	 * Get default route by application
	 *
	 * @param Application $application
	 * @param bool $enabled
	 *
	 * @return object
	 */
	public function getDefaultByApplication(Application $application, $enabled = true)
	{
		return $this->findOneBy(array(
			'idApplication'	=> $application->idApplication,
			'isDefault'			=> true,
			'isEnabled'			=> $enabled,
		));
	}
}

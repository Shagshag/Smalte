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
			'application_id'	=> $application->id,
			'isDefault'			=> true,
			'isEnabled'			=> $enabled,
		));
	}
}
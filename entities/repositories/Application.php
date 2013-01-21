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

class Application extends Repository
{
	/**
	 * Get default application
	 *
	 * @param bool $enabled Applications enabled
	 *
	 * @return Application
	 */
	public function getDefault($enabled = true)
	{
		return $this->findOneBy(array(
			'isDefault'	=> true,
			'isEnabled'	=> $enabled,
		));
	}

	/**
	 * Get application by prefix
	 *
	 * @param string $prefix Prefix
	 * @param bool $enabled Applications enabled
	 *
	 * @return Application
	 */
	public function getByPrefix($prefix, $enabled = true)
	{
		return $this->findOneBy(array(
			'prefix'	=> $prefix,
			'isEnabled'	=> $enabled,
		));
	}
}
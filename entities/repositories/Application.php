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

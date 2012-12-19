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

class Language extends Repository
{
	/**
	 * Get all IDS from criteria
	 *
	 * @param array $criteria Criteria
	 *
	 * @return array (E.g. en, fr, au, ...)
	 */
	public function getAllIds(array $criteria = array())
	{
		$ids = array();

		$languageEntities = $this->findBy($criteria);

		foreach ($languageEntities as $languageEntity)
		{
			$ids[] = $languageEntity->getId();
		}

		return $ids;
	}
}
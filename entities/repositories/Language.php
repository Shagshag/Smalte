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

namespace Entities\Repositories;

use Smalte\ORM\Repository;

class Language extends Repository
{
	/**
	 * Get all IDS from criteria
	 *
	 * @param array $criteria Criteria
	 *
	 * @return array (E.g. en, fr, au, ...)
	 */
	public function getAllIds($criteria)
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
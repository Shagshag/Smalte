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

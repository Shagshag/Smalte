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

namespace Entities;

class Language
{
	/** @var string ID (E.g. en, fr, au, ...) */
	protected $idLanguage;

	/** @var string Name */
	protected $name;

	/** @var bool Main */
	protected $isMain = false;

	/** @var bool Enabled */
	protected $isEnabled = true;

	/** @var \DateTime Created date */
	protected $dateCreated;

	/** @var \DateTime Updated date */
	protected $dateUpdated;

	/**
	 * @param string $id ID (E.g. en, fr, au, ...)
	 */
	public function setId($idLanguage)
	{
		$this->idLanguage = $idLanguage;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->idLanguage;
	}

	/**
	 * @param string $name Name of application
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param $main boolean Main
	 */
	public function setIsMain($main)
	{
		$this->isMain = (bool)$main;
	}

	/**
	 * @return bool
	 */
	public function getIsMain()
	{
		return $this->isMain;
	}

	/**
	 * @param boolean $enabled Enabled
	 */
	public function setIsEnabled($enabled)
	{
		$this->isEnabled = (bool)$enabled;
	}

	/**
	 * @return boolean
	 */
	public function getIsEnabled()
	{
		return $this->isEnabled;
	}

	/**
	 * @param \DateTime $date
	 */
	public function setDateCreated(\DateTime $date)
	{
		//$this->dateCreated = $date;
		$this->dateCreated = $date->format('Y-m-d H:i:s'); // @todo Raphael: Fix it please!
	}

	/**
	 * @return \DateTime
	 */
	public function getDateCreated()
	{
		return $this->dateCreated;
	}

	/**
	 * @param \DateTime $date
	 */
	public function setDateUpdated(\DateTime $date)
	{
		//$this->dateUpdated = $date;
		$this->dateUpdated = $date->format('Y-m-d H:i:s'); // @todo Raphael: Fix it please!
	}

	/**
	 * @return \DateTime
	 */
	public function getDateUpdated()
	{
		return $this->dateUpdated;
	}
}
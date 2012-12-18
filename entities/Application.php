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

class Application
{
	/** @var int ID */
	protected $id;

	/** @var string Name */
	protected $name;

	/** @var string Route prefix of application (E.g. admin) */
	protected $prefix;

	/** @var bool Enabled */
	protected $isEnabled = true;

	/** @var \DateTime Created date */
	protected $dateCreated;

	/** @var \DateTime Updated date */
	protected $dateUpdated;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
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
	 * @param string $prefix Route prefix of application (E.g. admin)
	 */
	public function setPrefix($prefix)
	{
		$this->prefix = $prefix;
	}

	/**
	 * @return string
	 */
	public function getPrefix()
	{
		return $this->prefix;
	}

	/**
	 * @param boolean $enabled Enabled
	 */
	public function setIsEnabled($enabled)
	{
		$this->isEnabled = $enabled;
	}

	/**
	 * @return boolean
	 */
	public function getIsEnabled()
	{
		return $this->isEnabled;
	}

	/**
	 * @return \DateTime
	 */
	public function getDateCreated()
	{
		return $this->dateCreated;
	}

	/**
	 * @return \DateTime
	 */
	public function getDateUpdated()
	{
		return $this->dateUpdated;
	}
}
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

namespace Entities;

class Application
{
	/** @var int ID */
	protected $idApplication;

	/** @var string Name */
	protected $name;

	/** @var string Route prefix of application (E.g. admin) */
	protected $prefix;

	/** @var bool Default */
	protected $isDefault = true;

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
		return $this->idApplication;
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
	 * @param boolean $isDefault Default
	 */
	public function setIsDefault($isDefault)
	{
		$this->isDefault = $isDefault;
	}

	/**
	 * @return boolean
	 */
	public function getIsDefault()
	{
		return $this->isDefault;
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

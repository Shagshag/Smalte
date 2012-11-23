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

use Smalte\ORM\Entity;

class Language extends Entity
{
	/** @var string ID (E.g. en, fr, au, ...) */
	protected $id;

	/** @var string Name */
	protected $name;

	/** @var bool Main */
	protected $main = false;

	/** @var bool Enabled */
	protected $enabled = true;

	/** @var \DateTime Created date */
	protected $created;

	/** @var \DateTime Updated date */
	protected $updated;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setCreated(new \DateTime('now'));
	}

	/**
	 * @param string $id ID (E.g. en, fr, au, ...)
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
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
	 * @param $main boolean Main
	 */
	public function setMain($main)
	{
		$this->main = (bool)$main;
	}

	/**
	 * @return bool
	 */
	public function getMain()
	{
		return $this->main;
	}

	/**
	 * @param boolean $enabled Enabled
	 */
	public function setEnabled($enabled)
	{
		$this->enabled = $enabled;
	}

	/**
	 * @return boolean
	 */
	public function getEnabled()
	{
		return $this->enabled;
	}

	/**
	 * @param \DateTime $created Created date
	 */
	public function setCreated($created)
	{
		$this->created = $created;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @param \DateTime $updated Updated date
	 */
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}

	/**
	 * @return \DateTime
	 */
	public function getUpdated()
	{
		return $this->updated;
	}
}
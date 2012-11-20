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

namespace Entities;

use Smalte\ORM\Entity;

class Application extends Entity
{
	/** @var int ID */
	protected $id;

	/** @var string Name */
	protected $name;

	/** @var string Route prefix of application (E.g. admin) */
	protected $prefix;

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
	 * @param int $id ID
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

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
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

class Route extends Entity
{
	/** @var int ID */
	protected $id;

	/** @var string Name */
	protected $name;

	/** @var string Pattern */
	protected $pattern;

	/** @var string Module */
	protected $module;

	/** @var \Entities\Application Application */
	protected $application;

	/** @var string Controller */
	protected $controller;

	/** @var string Action */
	protected $action;

	/** @var string Requirements */
	protected $requirements;

	/** @var bool Enabled route */
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
	 * @param string $name Name
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
	 * @param string $pattern Pattern
	 */
	public function setPattern($pattern)
	{
		$this->pattern = $pattern;
	}

	/**
	 * @return string
	 */
	public function getPattern()
	{
		return $this->pattern;
	}


	/**
	 * @param string $module Module
	 */
	public function setModule($module)
	{
		$this->module = $module;
	}

	/**
	 * @return string
	 */
	public function getModule()
	{
		return $this->module;
	}

	/**
	 * @param \Entities\Application $application Application
	 */
	public function setApplication(\Entities\Application $application)
	{
		$this->application = $application;
	}

	/**
	 * @return \Entities\Application
	 */
	public function getApplication()
	{
		return $this->application;
	}

	/**
	 * @param string $controller Controller
	 */
	public function setController($controller)
	{
		$this->controller = $controller;
	}

	/**
	 * @return string
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * @param string $action Action
	 */
	public function setAction($action)
	{
		$this->action = $action;
	}

	/**
	 * @return string
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * @param string $requirements Requirements
	 */
	public function setRequirements($requirements)
	{
		$requirements = \json_encode($requirements);

		$this->requirements = $requirements !== 'null'
			? $requirements
			: NULL;
	}

	/**
	 * @return string
	 */
	public function getRequirements()
	{
		return \json_decode($this->requirements);
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

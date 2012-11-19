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

class Route extends \Smalte\ORM\Entity
{
	/** @var string Route name */
	protected $name;

	/** @var string Route pattern */
	protected $pattern;

	/** @var string Module */
	protected $module;

	/** @var string Application */
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
	 * @param string $action
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
	 * @param string $application
	 */
	public function setApplication($application)
	{
		$this->application = $application;
	}

	/**
	 * @return string
	 */
	public function getApplication()
	{
		return $this->application;
	}

	/**
	 * @param string $controller
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
	 * @param \DateTime $created
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
	 * @param boolean $enabled
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
	 * @param string $module
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
	 * @param string $name
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
	 * @param string $pattern
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
	 * @param string $requirements
	 */
	public function setRequirements($requirements)
	{
		$this->requirements = \json_encode($requirements);
	}

	/**
	 * @return string
	 */
	public function getRequirements()
	{
		return \json_decode($this->requirements);
	}

	/**
	 * @param \DateTime $updated
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

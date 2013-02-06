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

class Route
{
	/** @var int ID */
	protected $idRoute;

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

	/** @var string Methods (E.g. GET|POST|...) */
	protected $methods = 'GET';

	/** @var bool Localized route */
	protected $isLocalized = true;

	/** @var bool Default route */
	protected $isDefault = false;

	/** @var bool Enabled route */
	protected $isEnabled = true;

	/** @var \DateTime Created date */
	protected $dateCreated;

	/** @var \DateTime Updated date */
	protected $dateUpdated;

	protected $idApplication;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->idRoute;
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
	 * @param string $methods Methods (E.g. GET|POST|...)
	 */
	public function setMethods($methods)
	{
		$this->methods = $methods;
	}

	/**
	 * @return string
	 */
	public function getMethods()
	{
		return $this->methods;
	}

	/**
	 * @param boolean $isLocalized
	 */
	public function setIsLocalized($isLocalized)
	{
		$this->isLocalized = $isLocalized;
	}

	/**
	 * @return boolean
	 */
	public function getIsLocalized()
	{
		return $this->isLocalized;
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

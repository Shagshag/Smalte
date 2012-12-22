<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * CachedContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class CachedContainer extends Container
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array();
        $this->scopeChildren = array();
    }

    /**
     * Gets the 'database' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\ORM\Database\PDODatabase A Smalte\ORM\Database\PDODatabase instance.
     */
    protected function getDatabaseService()
    {
        return $this->services['database'] = new \Smalte\ORM\Database\PDODatabase('mysql:host=localhost;dbname=smalte', 'root', 'root');
    }

    /**
     * Gets the 'database.definition' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\ORM\Definitions\Definitions A Smalte\ORM\Definitions\Definitions instance.
     */
    protected function getDatabase_DefinitionService()
    {
        $this->services['database.definition'] = $instance = new \Smalte\ORM\Definitions\Definitions();

        $instance->addParser($this->get('database.yamlparser'));
        $instance->addSchemas('entities/schemas/');

        return $instance;
    }

    /**
     * Gets the 'database.yamlparser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\ORM\Definitions\Parser\YamlParser A Smalte\ORM\Definitions\Parser\YamlParser instance.
     */
    protected function getDatabase_YamlparserService()
    {
        return $this->services['database.yamlparser'] = new \Smalte\ORM\Definitions\Parser\YamlParser();
    }

    /**
     * Gets the 'entitymanager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\ORM\EntityManager A Smalte\ORM\EntityManager instance.
     */
    protected function getEntitymanagerService()
    {
        return $this->services['entitymanager'] = new \Smalte\ORM\EntityManager($this->get('database'), $this->get('database.definition'), $this->get('event.dispatcher'));
    }

    /**
     * Gets the 'event.dispatcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\EventDispatcher\EventDispatcher A Symfony\Component\EventDispatcher\EventDispatcher instance.
     */
    protected function getEvent_DispatcherService()
    {
        return $this->services['event.dispatcher'] = new \Symfony\Component\EventDispatcher\EventDispatcher();
    }

    /**
     * Gets the 'mailing' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\Mailer\Mailer A Smalte\Mailer\Mailer instance.
     */
    protected function getMailingService()
    {
        return $this->services['mailing'] = call_user_func(array('Smalte\\Mailer\\Mailer', 'create'), array('transport' => 'smtp', 'host' => 'localhost', 'username' => NULL, 'password' => NULL));
    }

    /**
     * Gets the 'request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpFoundation\Request A Symfony\Component\HttpFoundation\Request instance.
     */
    protected function getRequestService()
    {
        return $this->services['request'] = call_user_func(array('Symfony\\Component\\HttpFoundation\\Request', 'createFromGlobals'));
    }

    /**
     * Gets the 'templating' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\Template\Template A Smalte\Template\Template instance.
     */
    protected function getTemplatingService()
    {
        $this->services['templating'] = $instance = new \Smalte\Template\Template($this->get('templating.adapter'));

        $instance->setTemplateDirectory('tests/features/template/templates/');

        return $instance;
    }

    /**
     * Gets the 'templating.adapter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\Template\Adapters\Phtml A Smalte\Template\Adapters\Phtml instance.
     */
    protected function getTemplating_AdapterService()
    {
        return $this->services['templating.adapter'] = new \Smalte\Template\Adapters\Phtml();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!array_key_exists($name, $this->parameters)) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        return array_key_exists(strtolower($name), $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritDoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }
    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'security' => array(
                'token' => 'EditMePlease',
            ),
            'security.token' => 'EditMePlease',
            'database' => array(
                'master' => array(
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'port' => NULL,
                    'dbname' => 'smalte',
                    'user' => 'root',
                    'password' => 'root',
                    'charset' => 'UTF8',
                ),
            ),
            'database.master' => array(
                'driver' => 'mysql',
                'host' => 'localhost',
                'port' => NULL,
                'dbname' => 'smalte',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'UTF8',
            ),
            'database.master.driver' => 'mysql',
            'database.master.host' => 'localhost',
            'database.master.port' => NULL,
            'database.master.dbname' => 'smalte',
            'database.master.user' => 'root',
            'database.master.password' => 'root',
            'database.master.charset' => 'UTF8',
            'mail' => array(
                'transport' => 'smtp',
                'host' => 'localhost',
                'username' => NULL,
                'password' => NULL,
            ),
            'mail.transport' => 'smtp',
            'mail.host' => 'localhost',
            'mail.username' => NULL,
            'mail.password' => NULL,
            'database.master.dsn' => 'mysql:host=localhost;dbname=smalte',
            'database.schemas.directory' => 'entities/schemas/',
            'templating.directory' => 'tests/features/template/templates/',
        );
    }
}

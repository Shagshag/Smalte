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
     * Gets the 'mailing' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Smalte\Mailer\Mailer A Smalte\Mailer\Mailer instance.
     */
    protected function getMailingService()
    {
        return $this->services['mailing'] = call_user_func(array('Smalte\\Mailer\\Mailer', 'create'), array('transport' => 'mail'));
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
            'mailing.transport' => 'mail',
            'templating.directory' => 'tests/features/template/templates/',
        );
    }
}

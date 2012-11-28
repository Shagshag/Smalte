<?php $container['mailing.configuration'] = array (
  'transport' => 'mail',
);
$container['templating.adapater'] = 'Smalte\Template\Adapters\Phtml';
$container['templating.directory'] = 'tests/features/template/templates/';
$container['mailing'] = function ($c) {
						$object = call_user_func_array(array('Smalte\Mailer\Mailer', 'create'), array (
  0 => $c['mailing.configuration'],
));
						
						return $object;
					};
$container['templating'] = function ($c) {
						$object = new Smalte\Template\Template(array (
  0 => new $c['templating.adapater'](),
));
						call_user_func_array(array($object, 'setTemplateDirectory'), array (
  0 => $c['templating.directory'],
));
						return $object;
					};
$container['request'] = function ($c) {
						$object = call_user_func_array(array('Symfony\Component\HttpFoundation\Request', 'createFromGlobals'), array (
));
						
						return $object;
					};
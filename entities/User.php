<?php
namespace Entities;

class User extends \Smalte\ORM\Entity
{
    public $id;

    public $name;
    
    public function testHelpers()
    {
    	$this->callHelper('position.up', array(
    		'titi' => 'toto',
    	));
    }
}
<?php
namespace Entities\Repositories;

use Smalte\ORM\Repository;

class User extends Repository
{
    public function doSomething()
    {
    	echo 'HELLO REPOSITORY<br />';
    }
}
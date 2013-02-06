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

namespace Entities\Repositories;

use Smalte\ORM\Repository;

class User extends Repository
{
    public function doSomething()
    {
    	echo 'HELLO REPOSITORY<br />';
    }
}

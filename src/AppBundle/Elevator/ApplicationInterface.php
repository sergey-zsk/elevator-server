<?php
/**
 * Created by PhpStorm.
 * User: Sergey Z
 * Date/Time: 18.03.17 2:23
 */

namespace AppBundle\Elevator;


interface ApplicationInterface
{
    /**
     * @return self
     */
    public function execute();
}
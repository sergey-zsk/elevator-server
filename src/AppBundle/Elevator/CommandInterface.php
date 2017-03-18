<?php
/**
 * Created by PhpStorm.
 * User: Sergey Z
 * Date/Time: 18.03.17 2:23
 */

namespace AppBundle\Elevator;


interface CommandInterface
{
    /**
     * Process current state
     *
     * @return self
     */
    public function execute();
}
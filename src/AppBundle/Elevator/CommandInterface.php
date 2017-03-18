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
     * @param Elevator $elevator
     * @return CommandInterface
     */
    public function execute(Elevator $elevator) : CommandInterface;

    /**
     * Description
     *
     * @return string
     */
    public function description();

    /**
     * Command Id
     *
     * @return int
     */
    public function id();
}
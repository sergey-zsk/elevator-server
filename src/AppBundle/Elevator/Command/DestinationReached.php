<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


use AppBundle\Elevator\CommandInterface;
use AppBundle\Elevator\Elevator;

class DestinationReached extends CommandDefault
{

    const ID = 30;

    /**
     * {@inheritdoc}
     */
    public function id()
    {
        return self::ID;
    }

    /**
     * {@inheritdoc}
     */
    public function description()
    {
        return 'Floor %s is reached';
    }

    /**
     * {@inheritdoc}
     */
    protected function printInitMessage()
    {
        return ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        $message = sprintf($this->description(), $elevator->getCurrentFloor());
        $this->log($message);

        return $this->getCommandFactory()->createCommand(OpenTheDoors::ID);
    }

}
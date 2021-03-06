<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


use AppBundle\Elevator\Command\Util\TheDoors;
use AppBundle\Elevator\CommandInterface;
use AppBundle\Elevator\Elevator;

class OpenTheDoors extends TheDoors
{

    const ID = 40;

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
        return 'Opening the doors';
    }

    /**
     * {@inheritdoc}
     */
    protected function next(Elevator $elevator): CommandInterface
    {
        return $this->getCommandFactory()->createCommand(WaitingInternal::ID);
    }
}

<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


use AppBundle\Elevator\Command\Util\CommandDefault;
use AppBundle\Elevator\CommandInterface;
use AppBundle\Elevator\Elevator;

class NoCommand extends CommandDefault
{

    const ID = 60;

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
        return 'No any command';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        return $this->getCommandFactory()->createCommand(CloseTheDoors::ID);
    }

}
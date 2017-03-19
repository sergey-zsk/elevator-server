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

class Moving extends CommandDefault
{

    const ID = 20;

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
        return 'Moving (to requested floor)';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        while (true) {
            $this->log($elevator->toJson());

            $from = $elevator->getCurrentFloor();
            $to = $elevator->getDestinationFloor();

            if ($from == $to) {
                $elevator->setDestinationFloor(null);
                break;
            }

            $diff = $to - $from;
            $sign = $diff / abs($diff);
            $floor = $elevator->getCurrentFloor() + $sign;

            $elevator->setCurrentFloor($floor);
            usleep($elevator->getElevatorSpeed());
        }

        return $this->getCommandFactory()->createCommand(DestinationReached::ID);
    }

}
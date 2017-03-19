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

class OpenTheDoors extends CommandDefault
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
        return 'Open the doors';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        sleep($elevator->getDoorsActivityTime());

        return parent::execute($elevator);
    }

}
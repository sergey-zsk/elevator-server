<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


class WaitingExternal extends CommandDefault
{

    /**
     * Return command description
     */
    protected function description()
    {
        return 'Waiting for commands from floors';
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function execute()
//    {
//        return $this;
//    }
}
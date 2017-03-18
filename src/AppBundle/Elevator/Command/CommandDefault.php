<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


use AppBundle\Elevator\CommandInterface;

class CommandDefault implements CommandInterface
{

    /**
     * CommandDefault constructor.
     */
    function __construct()
    {
        echo '[', date('Y-m-d H:i:s O'), ']: ', $this->description(), "\n";
    }

    /**
     * Return command description
     */
    protected function description()
    {
        return 'Default command that does nothing (should never happen in real environment)';
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        return $this;
    }
}
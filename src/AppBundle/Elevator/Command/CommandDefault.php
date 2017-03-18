<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


use AppBundle\Elevator\CommandFactory;
use AppBundle\Elevator\CommandInterface;
use AppBundle\Elevator\Elevator;

abstract class CommandDefault implements CommandInterface
{
    /**
     * @var CommandFactory
     */
    protected $commandFactory;

    /**
     * CommandDefault constructor
     *
     * @param CommandFactory $commandFactory
     */
    function __construct(CommandFactory $commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function id();

    /**
     * {@inheritdoc}
     */
    abstract public function description();

    /**
     * @return CommandFactory
     */
    public function getCommandFactory(): CommandFactory
    {
        return $this->commandFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        return $this;
    }

}
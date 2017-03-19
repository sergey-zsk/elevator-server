<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command\Util;


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
        $this->printInitMessage();
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
     * Simplest logging functionality
     *
     * @param string $message
     * @param bool $isEol
     * @param bool $isRaw
     * @return CommandDefault
     */
    protected function log(string $message, bool $isEol = true, bool $isRaw = false) : CommandDefault
    {
        $eol = '';
        if ($isEol) {
            $eol = "\n";
        }

        if ($isRaw) {
            echo $message, $eol;
            return $this;
        }

        echo '[', date('Y-m-d H:i:s O'), '], STE [' . $this->id() . ']: ', $message, $eol;

        return $this;
    }

    /**
     * Initialization message
     */
    protected function printInitMessage()
    {
        $this->log($this->description());
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        return $this;
    }

}
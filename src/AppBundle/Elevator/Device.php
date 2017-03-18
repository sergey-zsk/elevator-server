<?php
/**
 * Emulate "elevator" device that really is just State Machine.
 * "Device" is main loop (but not "state").
 *
 * User: Sergey Z
 * Date/Time: 17.03.17 0:11
 */

namespace AppBundle\Elevator;

class Device
{

    /**
     * Current command (can be only 1 state at any time)
     *
     * @var CommandInterface
     */
    protected $command;

    /**
     * @var Elevator
     */
    protected $elevator;

    /**
     * @var int
     */
    protected $delay;

    /**
     * Device constructor.
     * @param CommandInterface $command
     * @param Elevator $elevator
     * @param int $delay
     */
    function __construct(CommandInterface $command, Elevator $elevator, int $delay = 1000)
    {
        $this->command = $command;
        $this->elevator = $elevator;
        $this->delay = $delay;
    }

    /**
     * Main loop
     */
    public function execute()
    {
        while (true) {
            $this->command = $this->getCommand()->execute($this->getElevator());
            usleep($this->getDelay());
        }

    }

    /**
     * @return CommandInterface
     */
    public function getCommand(): CommandInterface
    {
        return $this->command;
    }

    /**
     * @return int
     */
    public function getDelay(): int
    {
        return $this->delay;
    }

    /**
     * @return Elevator
     */
    public function getElevator(): Elevator
    {
        return $this->elevator;
    }
}

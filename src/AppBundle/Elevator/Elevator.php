<?php
/**
 * Emulate elevator logic.
 *
 * User: Sergey Z
 * Date/Time: 17.03.17 0:11
 */

namespace AppBundle\Elevator;

class Elevator
{
    /**
     * Number of microseconds to reach next floor
     *
     * @see usleep
     * @var int
     */
    protected $elevatorSpeed = 0;

    /**
     * Total number of floors
     *
     * @var int
     */
    protected $totalFloors = 0;

    /**
     * Number of microseconds to open/close doors
     *
     * @var int
     */
    protected $waitingExternalSeconds = 0;

    /**
     * Current floor
     *
     * @var int
     */
    protected $currentFloor = 0;

    /**
     * Elevator constructor.
     *
     * @param int $totalFloors
     * @param int $elevatorSpeed
     * @param int $waitingExternalSeconds
     * @param int $currentFloor
     */
    function __construct(int $totalFloors, int $elevatorSpeed, int $waitingExternalSeconds, int $currentFloor)
    {
        $this->totalFloors = $totalFloors;
        $this->elevatorSpeed = $elevatorSpeed;
        $this->waitingExternalSeconds = $waitingExternalSeconds;
        $this->currentFloor = $currentFloor;
    }

    /**
     * @return int
     */
    public function getElevatorSpeed(): int
    {
        return $this->elevatorSpeed;
    }

    /**
     * @return int
     */
    public function getTotalFloors(): int
    {
        return $this->totalFloors;
    }

    /**
     * @return int
     */
    public function getWaitingExternalSeconds(): int
    {
        return $this->waitingExternalSeconds;
    }

    /**
     * @return int
     */
    public function getCurrentFloor(): int
    {
        return $this->currentFloor;
    }

}

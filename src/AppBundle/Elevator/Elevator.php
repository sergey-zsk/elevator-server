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
     * Number of microseconds to open/close the doors
     *
     * @var int
     */
    protected $doorsActivityTime = 0;

    /**
     * Current floor
     *
     * @var int
     */
    protected $currentFloor = 0;

    /**
     * Destination floor
     *
     * @var int|null
     */
    protected $destinationFloor = null;

    /**
     * How long (in seconds) we can wait until the doors are closed
     *
     * @var int
     */
    protected $waitingInternalSeconds;

    /**
     * Elevator constructor.
     *
     * @param int $totalFloors
     * @param int $elevatorSpeed
     * @param int $doorsActivityTime
     * @param int $currentFloor
     */
    function __construct(int $totalFloors, int $elevatorSpeed, int $doorsActivityTime, int $waitingInternalSeconds, int $currentFloor)
    {
        $this->totalFloors = $totalFloors;
        $this->elevatorSpeed = $elevatorSpeed;
        $this->currentFloor = $currentFloor;
        $this->doorsActivityTime = $doorsActivityTime;
        $this->waitingInternalSeconds = $waitingInternalSeconds;
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
    public function getDoorsActivityTime(): int
    {
        return $this->doorsActivityTime;
    }

    /**
     * @return int|null
     */
    public function getDestinationFloor()
    {
        return $this->destinationFloor;
    }

    /**
     * @param int|null $floor
     * @return $this
     */
    public function setDestinationFloor($floor) : Elevator
    {
        // TODO: Move this logic to separate class (this requires at least one more new layer in hierarchy)
        if ($floor === null) {
            $this->destinationFloor = $floor;
            return $this;
        }

        $maxFloors = $this->getTotalFloors();
        if ($floor > $maxFloors) {
            $floor = $maxFloors;
        }

        $this->destinationFloor = $floor;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentFloor(): int
    {
        return $this->currentFloor;
    }

    /**
     * @param int $currentFloor
     * @return Elevator
     */
    public function setCurrentFloor(int $currentFloor) : Elevator
    {
        $this->currentFloor = $currentFloor;
        return $this;
    }

    /**
     * @return int
     */
    public function getWaitingInternalSeconds(): int
    {
        return $this->waitingInternalSeconds;
    }

    /**
     * Convert related to floor variables in JSON
     *
     * @return string
     */
    public function toJson()
    {
        $data = [
            'totalFloors' => $this->getTotalFloors(),
            'currentFloor' => $this->getCurrentFloor(),
            'destinationFloor' => $this->getDestinationFloor(),
        ];

        return json_encode($data);
    }

}

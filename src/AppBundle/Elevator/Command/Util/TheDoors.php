<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command\Util;


use AppBundle\Elevator\CommandInterface;
use AppBundle\Elevator\Elevator;

abstract class TheDoors extends CommandDefault
{

    /**
     * {@inheritdoc}
     */
    protected function printInitMessage()
    {
        return ;
    }

    /**
     * @param Elevator $elevator
     * @return TheDoors
     */
    protected function displayProgress(Elevator $elevator)  : TheDoors
    {
        $this->log($this->description(), false);

        $doorsActivity = $elevator->getDoorsActivityTime();

        $start = microtime(true);
        $progress = $start;

        $displayRange = ((float) $doorsActivity) / 7;

        while (true) {
            $current = microtime(true);

            if ($current - $start > $doorsActivity) {
                $this->log(' done', true, true);
                break;
            }

            if ($current - $progress > $displayRange) {
                $progress = $current;
                $this->log('.', false, true);
            }

            usleep(10000);
        }

        return $this;
    }

    /**
     * @param Elevator $elevator
     * @return CommandInterface
     */
    abstract protected function next(Elevator $elevator) : CommandInterface;

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        return $this->displayProgress($elevator)->next($elevator);
    }

}
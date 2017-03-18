<?php
/**
 * Command factory
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator;


use Symfony\Component\DependencyInjection\Container;

class CommandFactory
{
    /**
     * @var array
     */
    protected $commands;

    /**
     * @var Container
     */
    protected $container;

    /**
     * CommandFactory constructor.
     *
     * @param array $commands
     */
    function __construct(Container $container, array $commands)
    {
        $this->container = $container;

        foreach ($commands as $command) {
            $this->commands[$command['id']] = $command['injection'];
        }
    }

    /**
     * Create command (there is no any error checking)
     *
     * @param string $id
     * @return CommandInterface
     */
    public function createCommand(string $id) {
        return $this->getContainer()->get($this->commands[$id]);
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

}
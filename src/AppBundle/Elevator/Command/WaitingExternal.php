<?php
/**
 * Default command
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Command;


use AppBundle\Elevator\AmqpConnect;
use AppBundle\Elevator\Command\Util\CommandDefault;
use AppBundle\Elevator\CommandFactory;
use AppBundle\Elevator\CommandInterface;
use AppBundle\Elevator\Elevator;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Config\Definition\Exception\Exception;

class WaitingExternal extends CommandDefault
{

    const ID = 10;
    const AMQP_TAG = 'waiting-external';

    /**
     * @var AmqpConnect
     */
    protected $connect;

    /**
     * @var null
     */
    protected $floor = null;

    /**
     * WaitingExternal constructor.
     * @param CommandFactory $commandFactory
     * @param AmqpConnect $connect
     */
    function __construct(CommandFactory $commandFactory, AmqpConnect $connect)
    {
        parent::__construct($commandFactory);

        $this->connect = $connect;
    }

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
        return 'Waiting for commands (floors, elevator)';
    }

    /**
     * @return AmqpConnect
     */
    public function getConnect(): AmqpConnect
    {
        return $this->connect;
    }

    /**
     * @return null
     */
    protected function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param null $floor
     */
    protected function setFloor($floor)
    {
        $this->floor = $floor;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Elevator $elevator) : CommandInterface
    {
        $this->getConnect()->purge();

        $channel = $this->getConnect()->consume(self::AMQP_TAG, array($this, 'callbackWaitingExternal'));
        $channel->wait();

        if (count($channel->callbacks) > 0) {
            throw new Exception('Elevator is broken!');
        }

        $elevator->setDestinationFloor($this->getFloor());

        return $this->getCommandFactory()->createCommand(Moving::ID);
    }

    /**
     *
     * @param AMQPMessage $msgObj
     */
    public function callbackWaitingExternal(AMQPMessage $msgObj)
    {
        $data = json_decode($msgObj->getBody());
        $this->setFloor($data->floor);

        $this->getConnect()->cancel(self::AMQP_TAG);
    }

}

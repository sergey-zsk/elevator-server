<?php
/**
 * Created by PhpStorm.
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Application;


use AppBundle\Elevator\ApplicationInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class ApplicationDefault implements ApplicationInterface
{
    /**
     * @var AMQPStreamConnection
     */
    protected $connection;

    /**
     * @var string
     */
    protected $queueName;

    /**
     * AmqpWrapperBase constructor.
     * @param AMQPStreamConnection $connection
     * @param string $queueName
     */
    function __construct(AMQPStreamConnection $connection, string $queueName)
    {
        $this->connection = $connection;
        $this->queueName = $queueName;
    }

    /**
     * @return AMQPStreamConnection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * Main application logic withiout AMQP wrapper
     *
     * @return mixed
     */
    abstract function doMain(AMQPChannel $channel, string $queueName);

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $channel = $this->getConnection()->channel();
        $channel->queue_declare($this->getQueueName(), false, false, false, false);

        $this->doMain($channel, $this->getQueueName());

        $channel->close();
        $this->getConnection()->close();

        return $this;
    }
}
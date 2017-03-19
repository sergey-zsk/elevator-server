<?php
/**
 * Command factory
 *
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AmqpConnect
{
    const CONN_TYPE_INTERNAL = 'internal';
    const CONN_TYPE_EXTERNAL = 'external';

    /**
     * @var AMQPStreamConnection
     */
    protected $connection;

    /**
     * @var string
     */
    protected $queueName;

    /**
     * @var \PhpAmqpLib\Channel\AMQPChannel
     */
    protected $channel;

    /**
     * AmqpConnect constructor.
     * @param AMQPStreamConnection $connection
     * @param string $queueName
     */
    function __construct(AMQPStreamConnection $connection, string $queueName)
    {
        $this->connection = $connection;
        $this->queueName = $queueName;

        $channel = $this->getConnection()->channel();
        $channel->queue_declare($this->getQueueName(), false, false, false, false);
        $this->channel = $channel;
    }

    function __destruct()
    {
        $this->getChannel()->close();
        $this->getConnection()->close();
    }

    /**
     * @return AMQPStreamConnection
     */
    public function getConnection(): AMQPStreamConnection
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
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    public function getChannel(): \PhpAmqpLib\Channel\AMQPChannel
    {
        return $this->channel;
    }

    /**
     * Send message
     *
     * @param string $message
     * @return $this
     */
    function publish(string $message)
    {
        $this->getChannel()->basic_publish(new AMQPMessage($message), '', $this->getQueueName());
        return $this;
    }

    /**
     * Clear queue quickly
     *
     * @return $this
     */
    public function purge()
    {
        $this->getChannel()->queue_purge($this->getQueueName());
        return $this;
    }

    /**
     * @param string $tag
     * @param $callback
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    public function consume(string $tag, $callback)
    {
        $this->getChannel()->basic_consume($this->getQueueName(), $tag, false, true, false, false, $callback);
        return $this->getChannel();
    }

    /**
     * @param string $tag
     */
    public function cancel(string $tag)
    {
        $this->getChannel()->basic_cancel($tag);
    }

}

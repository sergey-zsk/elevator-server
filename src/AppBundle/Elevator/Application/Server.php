<?php
/**
 * Created by PhpStorm.
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Application;


use AppBundle\Elevator\Elevator;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Server extends ApplicationDefault
{

    /**
     * Server constructor.
     * @param AMQPStreamConnection $connection
     * @param string $queueName
     */
    function __construct(AMQPStreamConnection $connection, string $queueName)
    {
        parent::__construct($connection, $queueName);
    }

    /**
     * {@inheritdoc}
     */
    function doMain(AMQPChannel $channel, string $queueName)
    {
        $callback = function($msg) {
            echo $msg->body, "\n";
        };

        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }
    }

    /**
     * @return Elevator
     */
    public function getElevator(): Elevator
    {
        return $this->elevator;
    }
}
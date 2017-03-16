<?php
/**
 * Created by PhpStorm.
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Application;


use PhpAmqpLib\Channel\AMQPChannel;

class Server extends ApplicationDefault
{

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
}
<?php
/**
 * Created by PhpStorm.
 * User: Sergey Z
 * Date/Time: 18.03.17 2:25
 */

namespace AppBundle\Elevator\Application;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class Client extends ApplicationDefault
{

    /**
     * {@inheritdoc}
     */
    function doMain(AMQPChannel $channel, string $queueName)
    {
        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', $queueName);
    }
}
<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ElevatorClientElevatorButtonCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elevator:button:elevator')
            ->setDescription('Launch elevator client')
            ->addArgument('floor', InputArgument::REQUIRED, 'Floor number')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $floor = $input->getArgument('floor');

        $conn1st = $this->getContainer()->get('amqp.connect.input.all');

        $data = [
            'floor' => $floor,
            'type' => $conn1st::CONN_TYPE_INTERNAL,
            'time' => microtime()
        ];

        $conn1st->publish(json_encode($data));

        $conn2nd = $this->getContainer()->get('amqp.connect.input.elevator');

        $data = [
            'floor' => $floor,
            'type' => $conn2nd::CONN_TYPE_INTERNAL,
            'time' => microtime()
        ];

        $conn2nd->publish(json_encode($data));
    }

}

<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ElevatorClientTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elevator:client-test')
            ->setDescription('Launch elevator client')
            ->addArgument('floor', InputArgument::REQUIRED, 'Floor number')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $floor = $input->getArgument('floor');

        $data = ['floor' => $floor, 'time' => mktime()];

        $connect = $this->getContainer()->get('amqp.connect.input.external');
        $connect->publish(json_encode($data));
    }

}

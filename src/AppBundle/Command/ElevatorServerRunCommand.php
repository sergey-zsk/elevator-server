<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ElevatorServerRunCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elevator:server-run')
            ->setDescription('Launch elevator server')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $elevator = $this->getContainer()->get('elevator_server');
        $elevator->execute();
    }

}

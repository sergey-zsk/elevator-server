<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ElevatorEmulateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elevator:emulate')
            ->setDescription('Emulate "elevator" device')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $device = $this->getContainer()->get('elevator_emulate');
        $device->execute();
    }

}

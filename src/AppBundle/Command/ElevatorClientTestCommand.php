<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ElevatorClientTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elevator:client-test')
            ->setDescription('Launch elevator client')
//            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $argument = $input->getArgument('argument');
//
//        if ($input->getOption('option')) {
//            // ...
//        }

        $elevator = $this->getContainer()->get('elevator_client');
        $elevator->execute();
    }

}

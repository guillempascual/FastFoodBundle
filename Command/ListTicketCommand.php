<?php

namespace FastFoodBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTicketCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fastfood:list-ticket')
            ->setDescription('List Tickets')
        ;
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $listTicket = $this->getContainer()->get('ticketlister');

        $allTickets = $listTicket->execute();
        $result = [];
        foreach ($allTickets as $ticket){
            $output->writeln($ticket->getId() . " - " .$ticket->getDate()->format('d-m-Y H:i:s') );
        }
    }
}

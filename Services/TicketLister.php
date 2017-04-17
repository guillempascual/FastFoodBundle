<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Entity\Ticket;

class TicketLister extends AbstractTicket
{
    public function execute()
    {
        $repo = $this->entityManager->getRepository(Ticket::class);
        $tickets = $repo->findAll();

        return $tickets;
    }
}

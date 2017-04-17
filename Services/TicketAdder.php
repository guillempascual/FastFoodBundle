<?php

namespace FastFoodBundle\Services;

use DateTime;
use FastFoodBundle\Event\TicketAddedEvent;
use FastFoodBundle\Entity\Ticket;

class TicketAdder extends AbstractTicket
{
    public function execute($details,$date,$name)
    {
        $ticket = new Ticket();
        $ticket->setDetails($details);
        $ticket->setDate($date);
        $ticket->setName($name);
        $this->entityManager->persist($ticket);
        $this->entityManager->flush($ticket);

        $event = new TicketAddedEvent($ticket);
        $this->eventDispatcher->dispatch(TicketAddedEvent::NAME, $event);

        return $ticket;
    }
}

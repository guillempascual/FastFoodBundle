<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Event\TicketUpdatedEvent;

class TicketUpdater extends AbstractTicket
{
    public function execute($id,$details,$date,$name)
    {
        $ticket = $this->entityManager->getRepository('FastFoodBundle:Ticket')->find($id);

        $ticket->setDetails($details);
        $ticket->setDate($date);
        $ticket->setName($name);

        $this->entityManager->flush($ticket);

        $event = new TicketUpdatedEvent($ticket);
        $this->eventDispatcher->dispatch(TicketUpdatedEvent::NAME, $event);

        return $ticket;
    }
}

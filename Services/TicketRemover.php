<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Event\TicketRemovedEvent;

class TicketRemover extends AbstractTicket
{
    public function execute($id)
    {

        $ticket = $this->entityManager->getRepository('FastFoodBundle:Ticket')->find($id);

        $ticketLines = $ticket->getTicketLines();
        foreach ($ticketLines as $ticketLine) {
            $this->entityManager->remove($ticketLine);
            $this->entityManager->flush();
        }

        $this->entityManager->remove($ticket);
        $this->entityManager->flush($ticket);

        $event = new TicketRemovedEvent($ticket);
        $this->eventDispatcher->dispatch(TicketRemovedEvent::NAME, $event);

        return true;
    }
}

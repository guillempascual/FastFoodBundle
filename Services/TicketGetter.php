<?php

namespace FastFoodBundle\Services;

class TicketGetter extends AbstractTicket
{
    public function execute($id)
    {
        $ticket = $this->entityManager->getRepository('FastFoodBundle:Ticket')->find($id);
        return $ticket;
    }
}

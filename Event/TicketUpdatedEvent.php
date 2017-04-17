<?php

namespace FastFoodBundle\Event;

use FastFoodBundle\Entity\Ticket;

/**
 * Created by PhpStorm.
 * User: guillempascual
 * Date: 20/2/17
 * Time: 19:28
 */
class TicketUpdatedEvent extends \Symfony\Component\EventDispatcher\Event
{
    const NAME = 'ticket.updated';

    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket= $ticket;
    }

    /**
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }


}
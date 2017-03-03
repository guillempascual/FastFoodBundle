<?php

namespace FastFoodBundle\Event;

use FastFoodBundle\Entity\Ticket;

/**
 * Created by PhpStorm.
 * User: guillempascual
 * Date: 20/2/17
 * Time: 19:28
 */
class TicketEvent extends \Symfony\Component\EventDispatcher\Event
{

    private $ticket;
    public function __construct(Ticket $ticket)
    {
        $this->ticket= $ticket;
    }

    /**
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->Ticket;
    }


}
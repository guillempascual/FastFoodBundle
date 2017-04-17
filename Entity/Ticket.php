<?php
/**
 * Created by PhpStorm.
 * User: guillempascual
 * Date: 27/2/17
 * Time: 19:42
 */

namespace FastFoodBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity;
 * @ORM\Table(name="ticket")
 */

class Ticket
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $details;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * One Ticket has Many TicketLines.
     * @ORM\OneToMany(targetEntity="TicketLine", mappedBy="ticket", cascade={"persist"})
     */
    private $ticketLines;

    public function __construct() {
        $this->ticketLines= new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return mixed
     */
    public function getTicketLines()
    {
        return $this->ticketLines;
    }

    public function addTicketLine(TicketLine $ticketLine)
    {
        $this->ticketLines->add($ticketLine);
        $ticketLine->setTicket($this);
    }

    public function removeTicketLine(TicketLine $ticketLine)
    {
        $this->ticketLines->remove($ticketLine);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
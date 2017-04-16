<?php
/**
 * Created by PhpStorm.
 * User: guillempascual
 * Date: 1/3/17
 * Time: 19:18
 */

namespace FastFoodBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity;
 * @ORM\Table(name="ticket_line")
 */

class TicketLine
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Many TicketLines have One Ticket.
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="ticketLines", cascade={"persist"})
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id", nullable = false)
     */
    private $ticket;

    /**
     * Many TicketLines have One Product.
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="ticketLines", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable = false)
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
     private $quantity;

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function setDescription($description)
    {
        return $this->product->setDescription($description);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->product->getDescription();
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->product->getPrice();
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return (float) $this->getQuantity() * $this->product->getPrice();
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->ticket->getDate();

    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->ticket->getDetails();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
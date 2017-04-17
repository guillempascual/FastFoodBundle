<?php

namespace FastFoodBundle\Event;
use FastFoodBundle\Entity\Product;
use Symfony\Component\EventDispatcher\Event;

/**
 * The order.placed event is dispatched each time an order is created
 * in the system.
 */
class ProductUpdatedEvent extends Event
{
    const NAME = 'product.updated';

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }
}
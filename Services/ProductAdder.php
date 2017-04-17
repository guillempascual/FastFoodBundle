<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Event\ProductAddedEvent;
use FastFoodBundle\Entity\Product;

class ProductAdder extends AbstractProduct
{
    public function execute($description,$price)
    {
        $product = new Product();
        $product->setDescription($description);
        $product->setPrice($price);
        $this->entityManager->persist($product);
        $this->entityManager->flush($product);

        $event = new ProductAddedEvent($product);
        $this->eventDispatcher->dispatch(ProductAddedEvent::NAME, $event);

        return $product;
    }
}

<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Event\ProductUpdatedEvent;

class ProductUpdater extends AbstractProduct
{
    public function execute($id,$description,$price)
    {
        $product = $this->entityManager->getRepository('FastFoodBundle:Product')->find($id);

        $product->setDescription($description);
        $product->setPrice($price);

        $this->entityManager->flush($product);

        $event = new ProductUpdatedEvent($product);
        $this->eventDispatcher->dispatch(ProductUpdatedEvent::NAME, $event);

        return $product;
    }
}

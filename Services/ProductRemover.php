<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Event\ProductRemovedEvent;

class ProductRemover extends AbstractProduct
{
    public function execute($id)
    {
        $product = $this->entityManager->getRepository('FastFoodBundle:Product')->find($id);
        $this->entityManager->remove($product);
        $this->entityManager->flush($product);

        $event = new ProductRemovedEvent($product);
        $this->eventDispatcher->dispatch(ProductRemovedEvent::NAME, $event);

        return true;
    }
}

<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Event\ProductUpdatedEvent;

class ProductGetter extends AbstractProduct
{
    public function execute($id)
    {
        $product = $this->entityManager->getRepository('FastFoodBundle:Product')->find($id);
        return $product;
    }
}

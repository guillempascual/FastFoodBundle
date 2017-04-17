<?php

namespace FastFoodBundle\Services;

class ProductGetter extends AbstractProduct
{
    public function execute($id)
    {
        $product = $this->entityManager->getRepository('FastFoodBundle:Product')->find($id);
        return $product;
    }
}

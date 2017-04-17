<?php

namespace FastFoodBundle\Services;

use FastFoodBundle\Entity\Product;

class ProductLister extends AbstractProduct
{
    public function execute()
    {
        $repo = $this->entityManager->getRepository(Product::class);
        $products = $repo->findAll();

        return $products;
    }
}

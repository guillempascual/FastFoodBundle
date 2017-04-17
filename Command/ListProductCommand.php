<?php

namespace FastFoodBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fastfood:list-product')
            ->setDescription('List Products')
        ;
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $listProduct = $this->getContainer()->get('productlister');

        $allProducts = $listProduct->execute();
        $result = [];
        foreach ($allProducts as $product){
            $output->writeln($product->getDescription());
        }
    }
}

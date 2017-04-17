<?php

namespace FastFoodBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fastfood:add-product')
            ->setDescription('Add Product')
            ->addArgument(
                'description',
                InputArgument::REQUIRED,
                'Description'
            )
            ->addArgument(
                'price',
                InputArgument::REQUIRED,
                'Price'
            )
        ;
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $addProduct= $this->getContainer()->get('productAdder');

        $description = $input->getArgument('description');
        $price = $input->getArgument('price');
        $addProduct->execute($description,$price);

        $output->writeln('Producto añadido');
    }
}
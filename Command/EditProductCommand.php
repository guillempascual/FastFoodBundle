<?php

namespace FastFoodBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EditProductCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('fastfood:edit-product')
            ->setDescription('Edit Product')
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'id'
            )
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
        $editProduct = $this->getContainer()->get('productUpdater');

        $id = $input->getArgument('id');
        $description = $input->getArgument('description');
        $price = $input->getArgument('price');
        $editProduct->execute($id,$description,$price);

        $output->writeln('Producto mofidicado');
    }
}
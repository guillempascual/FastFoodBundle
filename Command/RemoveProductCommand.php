<?php

namespace FastFoodBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fastfood:remove-product')
            ->setDescription('Remove Product')
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'id'
            )
        ;
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $removeProduct = $this->getContainer()->get('productRemover');
        $id = $input->getArgument('id');
        $removeProduct->execute($id);

        $output->writeln('Producto eliminando');
    }
}
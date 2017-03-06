<?php

namespace FastFoodBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use FastFoodBundle\Entity\TicketLine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('product', EntityType::class, array(
            'class' => 'FastFoodBundle:Product',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.description', 'ASC');
            },
            'choice_label' => function ($product) {
                return $product->getDescription();
            }
        ));
        $builder->add('quantity');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TicketLine::class,
        ));
    }
}
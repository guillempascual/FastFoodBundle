<?php
/**
 * Created by PhpStorm.
 * User: guillempascual
 * Date: 3/3/17
 * Time: 12:20
 */

namespace FastFoodBundle\Form\Type;

use FastFoodBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class NewTicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('details');
        $builder->add('date');

        //$builder->addEventSubscriber(new addTotalFieldSubscriber());
        $builder->setMethod('POST')
            ->add('save', SubmitType::class, array('label' => 'Add Lines To Ticket'))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
        ));
    }
}


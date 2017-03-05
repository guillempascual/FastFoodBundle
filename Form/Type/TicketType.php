<?php
/**
 * Created by PhpStorm.
 * User: guillempascual
 * Date: 3/3/17
 * Time: 12:20
 */

namespace FastFoodBundle\Form\Type;

use FastFoodBundle\Entity\Ticket;
use FastFoodBundle\Form\EventListener\addTotalFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('details');
        $builder->add('date');

        $builder->add('ticketlines', CollectionType::class, array(
            'entry_type' => TicketLineType::class,
            'allow_add' => true,
            'by_reference' => false
        ));

        $builder->addEventSubscriber(new addTotalFieldSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
        ));
    }
}


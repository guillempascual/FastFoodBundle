<?php
namespace FastFoodBundle\Form\EventListener;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class addTotalFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA  => 'addTotalField',
            FormEvents::PRE_SUBMIT    => 'addTotalField'
        );
    }

    public function addTotalField(FormEvent $event)
    {
        $ticketLine = $event->getData();
        $form = $event->getForm();
        $form->add('total', MoneyType::class, ['mapped' => false, 'data' => $ticketLine->getTotal()]);
    }
}
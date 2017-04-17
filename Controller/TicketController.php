<?php

namespace FastFoodBundle\Controller;

use DateTime;
use FastFoodBundle\Entity\Ticket;
use FastFoodBundle\Event\TicketEvent;
use FastFoodBundle\Form\Type\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    private $entityManager;
    private $eventDispatcher;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/ticket/delete/{id}", name="delete_ticket")
     */
    public function deleteAction($id)
    {
        $ticketGetter = $this->get('TicketGetter');
        $ticket = $ticketGetter->execute($id);

        $ticketRemover = $this->get('TicketRemover');
        $ticketRemover->execute($id);

        // replace this example code with whatever you need
        return $this->render('FastFoodBundle:Ticket:delete.html.twig', [
            'content' => $id,
        ]);
    }

    /**
     * @Route("/ticket/new", name="new_ticket")
     */
    public function addAction(Request $request)
    {
        $ticket = new Ticket();
        $ticket->setDate(new DateTime);

        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $ticketAdder = $this->get('TicketAdder');
            $ticketAdder->execute($ticket->getDetails(),$ticket->getDate(),$ticket->getName());

            return $this->redirectToRoute('list_ticket', array('id' => $ticket->getId()));
        }

        return $this->render('FastFoodBundle:Ticket:edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/ticket/edit/{id}", name="edit_ticket")
     */
    public function editAction(Request $request,$id)
    {
        $ticketGetter = $this->get('TicketGetter');
        $ticket= $ticketGetter->execute($id);

        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $ticketUpdater = $this->get('TicketUpdater');
            $ticketUpdater->execute($id,$ticket->getDetails(),$ticket->getDate(), $ticket->getName());

            return $this->redirectToRoute('list_ticket');
        }

        return $this->render('FastFoodBundle:Ticket:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/ticket/list", name="list_ticket")
     */
    public function listAction()
    {
        $ticketLister = $this->get('TicketLister');
        $tickets = $ticketLister->execute();

        // replace this example code with whatever you need
        return $this->render('FastFoodBundle:Ticket:list.html.twig', [
            'tickets' => $tickets,
        ]);
    }
}

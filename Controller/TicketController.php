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
        $this->entityManager = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->entityManager->getRepository(Ticket::class);
        $ticket = $repo->find($id);
        $this->entityManager->remove($ticket);
        $this->entityManager->flush();
        // replace this example code with whatever you need
        return $this->render('FastFoodBundle:Ticket:delete.html.twig', [
            'content' => $ticket,
        ]);
    }

    /**
     * @Route("/ticket/new", name="new_ticket")
     */
    public function addAction(Request $request)
    {
        $this->entityManager = $this->get('doctrine.orm.default_entity_manager');
        $this->eventDispatcher = $this->get('event_dispatcher');

        $ticket = new Ticket();
        $ticket->setDate(new DateTime);

        $form = $this->createForm(TicketType::class, $ticket);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

            $TicketCreatedEvent = new TicketEvent($ticket);
            $this->eventDispatcher->dispatch('movie', $TicketCreatedEvent);

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
        $this->entityManager = $this->get('doctrine.orm.default_entity_manager');
        $this->eventDispatcher = $this->get('event_dispatcher');

        $repo = $this->entityManager->getRepository(Ticket::class);
        $ticket= $repo->find($id);

        $form = $this->createForm(TicketType::class, $ticket);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();

            $this->entityManager->persist($ticket);
            $this->entityManager->flush();

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
        $this->entityManager = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->entityManager->getRepository(Ticket::class);
        $tickets = $repo->findAll();

        // replace this example code with whatever you need
        return $this->render('FastFoodBundle:Ticket:list.html.twig', [
            'tickets' => $tickets,
        ]);
    }
}

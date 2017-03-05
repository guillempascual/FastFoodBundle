<?php

namespace FastFoodBundle\Controller;

use DateTime;
use Doctrine\DBAL\Types\DecimalType;
use FastFoodBundle\Entity\Product;
use FastFoodBundle\Entity\Ticket;
use FastFoodBundle\Entity\TicketLine;
use FastFoodBundle\Form\Type\TicketType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    private $em;
    private $ed;

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
        $this->em = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->em->getRepository(Ticket::class);
        $ticket = $repo->find($id);
        $name = $ticket->getName();
        $this->em->remove($ticket);
        $this->em->flush();
        // replace this example code with whatever you need
        return $this->render('delete_ticket.html.twig', [
            'content' => $name,
        ]);
    }

    /**
     * @Route("/ticket/new", name="new_ticket")
     */
    public function addAction(Request $request)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');
        $this->ed = $this->get('event_dispatcher');

        // just setup a fresh $task object (remove the dummy data)
        $ticket = new Ticket();
        $ticket->setDate(new DateTime);
        $repo = $this->em->getRepository(Product::class);



        $form = $this->createForm(TicketType::class, $ticket);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... maybe do some form processing, like saving the Ticket and TicketLines objects
        }

        return $this->render('FastFoodBundle:Ticket:new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/ticket/list", name="list_ticket")
     */
    public function listAction()
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->em->getRepository(Ticket::class);
        $tickets = $repo->findAll();

        // replace this example code with whatever you need
        return $this->render('list_ticket.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    /**
     * @Route("/ticket/edit/{id}", name="edit_ticket")
     */
    public function editAction(Request $request, $id)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');

        // just setup a fresh $task object (remove the dummy data)
        $repo = $this->em->getRepository(Ticket::class);
        $ticket = $repo->find($id);

        $form = $this->createFormBuilder($ticket)
            ->add('customerCode', TextType::class)
            ->add('nameCode', TextType::class)
            ->add('pricePerCopy', MoneyType::class)
            ->add('pricePerScan', MoneyType::class)
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
            ->add('comment', TextType::class)
            ->add('active', TextType::class)
            ->setMethod('POST')
            ->add('save', SubmitType::class, array('label' => 'Save Ticket'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $ticket = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();
            $this->em->flush();

            //return $this->redirectToRoute('newSuccess');
        }

        return $this->render('add_ticket.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

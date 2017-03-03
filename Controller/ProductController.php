<?php

namespace FastFoodBundle\Controller;

use Doctrine\DBAL\Types\DecimalType;
use FastFoodBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    private $em;
    private $ed;

    /**
     * @Route("/product", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     */
    public function deleteAction($id)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->em->getRepository(Product::class);
        $product = $repo->find($id);
        $description = $product->getDescription();
        $this->em->remove($product);
        $this->em->flush();

        return $this->render('FastFoodBundle::product_delete.html.twig', [
            'content' => $description,
        ]);
    }

    /**
     * @Route("/product/add", name="product_add")
     */
    public function addAction(Request $request)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');
        $this->ed = $this->get('event_dispatcher');

        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('description', TextType::class)
            ->add('price', MoneyType::class)
            ->setMethod('POST')
            ->add('save', SubmitType::class, array('label' => 'Create Product'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $this->em->persist($product);
            $this->em->flush();
            return $this->redirectToRoute('product_list');
        }

        return $this->render('FastFoodBundle::product_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/product/list", name="product_list")
     */
    public function listAction()
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->em->getRepository(Product::class);
        $products = $repo->findAll();

        return $this->render('FastFoodBundle::product_list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function editAction(Request $request, $id)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');

        $repo = $this->em->getRepository(Product::class);
        $product = $repo->find($id);

        $form = $this->createFormBuilder($product)
            ->add('description', TextType::class)
            ->add('price', MoneyType::class)
            ->setMethod('POST')
            ->add('save', SubmitType::class, array('label' => 'Save Product'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('product_list');
        }

        return $this->render('FastFoodBundle::product_edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

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
        $productGetter = $this->get('ProductGetter');
        $product = $productGetter->execute($id);
        $description = $product->getDescription();

        $productRemover = $this->get('ProductRemover');
        $productRemover->execute($id);

        return $this->render('FastFoodBundle:Product:delete.html.twig', [
            'content' => $description,
        ]);
    }

    /**
     * @Route("/product/add", name="product_add")
     */
    public function addAction(Request $request)
    {
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
            $productAdder = $this->get('ProductAdder');
            $productAdder->execute($product->getDescription(),$product->getPrice());

            return $this->redirectToRoute('product_list');
        }

        return $this->render('FastFoodBundle:Product:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/product/list", name="product_list")
     */
    public function listAction()
    {
        $productLister = $this->get('ProductLister');
        $products = $productLister->execute();

        return $this->render('FastFoodBundle:Product:list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function editAction(Request $request, $id)
    {
        $productGetter = $this->get('ProductGetter');
        $product = $productGetter->execute($id);

        $form = $this->createFormBuilder($product)
            ->add('description', TextType::class)
            ->add('price', MoneyType::class)
            ->setMethod('POST')
            ->add('save', SubmitType::class, array('label' => 'Save Product'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $productUpdater = $this->get('ProductUpdater');
            $productUpdater->execute($id,$product->getDescription(),$product->getPrice());
            return $this->redirectToRoute('product_list');
        }

        return $this->render('FastFoodBundle:Product:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

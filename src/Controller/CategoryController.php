<?php

namespace App\Controller;

use App\Entity\Category;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryController extends Controller
{
    /**
     * @Route("/medic/category", name="category_list")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

         return $this->render('category/index.html.twig' , array
         ('categories' => $categories ));
    }

    /**
     * 
     * @Route("/medic/category/new/", name="new_category")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $category = new Category();

        $form = $this->createFormBuilder($category)
            ->add('area', TextType::class, array(
                'label' => 'Área',
                'attr'  => array('class'  => 'form-control') 
            ))

            ->add('icon', TextType::class, array(
                'label' => 'Icon (código del icono)',
                'attr'  => array(
                    'class'  => 'form-control',
                    'placehoder'=> 'código del icono'
                    ) 
            ))
           
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $area = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($area);
                $entityManager->flush();

                return $this->redirectToRoute('category_list');
            }

            return $this->render('category/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/medic/category/edit/{id}", name="update_category")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $category = new Category();

        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        $form = $this->createFormBuilder($category)
            ->add('area', TextType::class, array(
                'label' => 'Area',
                'attr'  => array('class'  => 'form-control') 
            ))

            ->add('icon', TextType::class, array(
                'label' => 'Icon (código del icono)',
                'attr'  => array(
                    'class'  => 'form-control',
                    'placehoder'=> 'código del icono'
                    ) 
            ))

            ->add('save', SubmitType::class, array(
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('category_list');
            }

            return $this->render('category/edit.html.twig', array(
                'form' => $form->createView(),
                'icon'  => $category->icon
            ));
    }

    /**
     * @Route("/medic/category/{id}",  name="category_show")
     */
    public function show($id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        return $this->render('category/show.html.twig' , array
        ('category' => $category ));
    }

    /**
     * @Route("/medic/category/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $category = $this->getDoctrine()->getRepository
        (Category::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}

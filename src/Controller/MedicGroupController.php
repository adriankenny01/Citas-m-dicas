<?php

namespace App\Controller;

use App\Entity\MedicGroup;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedicGroupController extends Controller
{

    /**
     * @Route("/group", name="group_list")
     */
    public function index()
    {
         $groups = $this->getDoctrine()->getRepository(MedicGroup::class)->findAll();

         return $this->render('medic_group/index.html.twig' , array
         ('groups' => $groups ));

    }

    /**
     * 
     * @Route("/group/new", name="new_group")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $group = new MedicGroup();

        $form = $this->createFormBuilder($group)
            ->add('name', TextType::class, array(
                'label' => 'Nombre',
                'attr'  => array('class'  => 'form-control') 
            ))
            
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $group = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($group);
                $entityManager->flush();

                return $this->redirectToRoute('group_list');
            }

            return $this->render('medic_group/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/group/edit/{id}", name="update_group")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $group = new MedicGroup();

        $group = $this->getDoctrine()->getRepository(MedicGroup::class)->find($id);

        $form = $this->createFormBuilder($group)
            ->add('name', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Nombre'))

            ->add('save', SubmitType::class, array(
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('group_list');
            }

            return $this->render('medic_group/edit.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * @Route("/group/{id}",  name="group_show")
     */
    public function show($id) {
        $group = $this->getDoctrine()->getRepository(MedicGroup::class)->find($id);

        return $this->render('medic_group/show.html.twig' , array
        ('group' => $group ));
    }

    /**
     *@Route("/group/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $group = $this->getDoctrine()->getRepository(MedicGroup::class)->find($id);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($group);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

}

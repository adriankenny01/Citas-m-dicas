<?php

namespace App\Controller;

use App\Entity\Appoinment;
use App\Entity\Patient;
use App\Entity\Medic;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AppoinmentController extends Controller
{
    /**
     * @Route("/appointment", name="appointment_list")
     */
    public function index()
    {
        $appointments = $this->getDoctrine()->getRepository(Appoinment::class)->findAll();

        $response['appointments'] = $this->EntityCollectionToArrayCollection($appointments);
        return $this->render('appointment/index.html.twig' , $response);
    }


    /**
     * @Route("/appointment/fetch", name="appointment_fetch")
     */
    public function appointment_fetch()
    {
        $appointments = $this->getDoctrine()->getRepository(Appoinment::class)->findAll();
        $events = $this->EntityCollectionToArrayCollection($appointments);
        
        return new Response(json_encode($events));
    }

    /**
     * 
     * @Route("/appointment/new", name="new_appointment")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $appointment = new Appoinment();

        $form = $this->createFormBuilder($appointment)
           
            ->add('title', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Titulo'))
            ->add('symptoms', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Simtomas'))
            ->add('medicaments', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Medicamentos'))
            ->add('sick', TextType::class, array('attr' =>
            array('class' => 'form-control', ), 'label' => 'Enfermedad'))
            
            ->add('Patient', EntityType::class, [
                'class' => Patient::class,
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($patient) {
                    return $patient->getFullName();
                },
                'label' => 'Nombre de paciente'
            ])
            
            
            ->add('start', DateType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Fecha cita',
            'widget' => 'single_text'))
            ->add('end', DateType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Fecha cita fin',
            'widget' => 'single_text'))
           
            ->add('medic', EntityType::class, [
                'class' => Medic::class, 
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($medic) {
                    return $medic->getName();
                },
                'choice_attr' =>  array('class' => 'form-control'),
                'label' => 'Medico'
            ])

            ->add('url', HiddenType::class, array('attr' =>
            array('class' => 'form-control'),'required' => false))
            
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $appointment = $form->getData();

                $em = $this->getDoctrine()->getManager();

                $LimitPatientAppoinmentPerDay = $em->getRepository('App:Appoinment')->ValidateQtyPerDay($appointment->getMedic()->getId(), $appointment->getStart());
                $PreviousPatientAppoinment = $em->getRepository('App:Appoinment')->ValidateAppoinment($appointment->getPatient()->getId(), $appointment->getStart());
                
                //validate qty of patient by that day
                if( $LimitPatientAppoinmentPerDay[0]['cantidad']  >= 1){

                    return $this->render('appointment/new.html.twig', array(
                        'form' => $form->createView(),
                        'cantidad_citas'    => 'Hemos llegado al límite de pacientes por el día de hoy.',
                        'existe_cita'    => 0
                    ));
                }else if( $PreviousPatientAppoinment[0]['cantidad']  >= 1 ){
                    return $this->render('appointment/new.html.twig', array(
                        'form' => $form->createView(),
                        'cantidad_citas' => 0,
                        'existe_cita'    => 'Ya existe este cita.'
                    ));
                }

                $entityManager = $this->getDoctrine()->getManager();
                $appointment->setState(1);
                $entityManager->persist($appointment);
                $entityManager->flush();

                return $this->redirectToRoute('appointment_list');
            }

            return $this->render('appointment/new.html.twig', array(
                'form' => $form->createView(),
                'cantidad_citas' => 0,
                'existe_cita'   => 0
            ));
    }

     /**
     * 
     * @Route("/appointment/edit/{id}", name="update_appointment")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $appointment = new Appoinment();

        $appointment = $this->getDoctrine()->getRepository(Appoinment::class)->find($id);

        //get image id from patient repository
        $patientPhoto = $this->getDoctrine()->getRepository(Patient::class)->getPhoto($appointment->get_PatientId());

            $form = $this->createFormBuilder($appointment)
            ->add('title', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Titulo'))
            ->add('symptoms', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Simtomas'))
            ->add('medicaments', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Medicamentos'))
            ->add('sick', TextType::class, array('attr' =>
            array('class' => 'form-control')))
            
            ->add('Patient', EntityType::class, [
                'class' => Patient::class,
                "attr"=>array('class' => 'form-control','label' => 'Paciente'),
                'choice_label' => function ($patient) {
                    return $patient->getFullName();
                }
                
            ])
            
            
            ->add('start', DateType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Fecha cita',
            'widget' => 'single_text'))
            ->add('end', DateType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Fecha cita fin',
            'widget' => 'single_text'))
        
            ->add('medic', EntityType::class, [
                'class' => Medic::class, 
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($medic) {
                    return $medic->getName();
                },
                'choice_attr' =>  array('class' => 'form-control')
                ,'label' => 'Medico'
            ])
            
            ->add('save', SubmitType::class, array(
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('appointment_list');
            }

            return $this->render('appointment/edit.html.twig', array(
                'form' => $form->createView(),
                'photo' => $patientPhoto,
                'full_name' =>  $appointment->getPatient()->getFullName()
            ));
    }

    /**
     * @Route("/appointment/{id}",  name="appointment_show")
     */
    public function show($id) {
        $appointment = $this->getDoctrine()->getRepository(Appoinment::class)->find($id);

        return $this->render('appointment/show.html.twig' , array
        ('appointment' => $appointment ));
        
    }

    /**
     * @Route("/appointment/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $appointment = $this->getDoctrine()->getRepository
        (Appoinment::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($appointment);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }


    public function EntityCollectionToArrayCollection($collection) {
        
        $serialize = [];
        if(!$collection)
            return;
        foreach($collection as $key => $entity){
            $serialize[] = $entity->toArray();
        }
        
        return $serialize;
    
    }
}

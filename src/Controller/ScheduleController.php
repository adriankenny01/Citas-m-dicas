<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Entity\Medic;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ScheduleController extends Controller
{
    /**
     * @Route("/schedule", name="schedule_list")
     */
    public function index()
    {
        $schedules = $this->getDoctrine()->getRepository(Schedule::class)->findAll();

        return $this->render('schedule/index.html.twig' , array
        ('schedules' => $schedules ));
    }

    /**
     * 
     * @Route("/schedule/new", name="new_schedule")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $schedule = new Schedule();

        $form = $this->createFormBuilder($schedule)
            ->add('day_one', ChoiceType::class, [
                'choices' => 
                [
                    'Lunes' => 'Lunes', 
                    'Martes' => 'Martes',
                    'Miercoles' => 'Miercoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'viernes',
                    'Sabado' => 'Sabado',
                    'Domingo' => 'Domingo'
                ],
                "attr"=>array('class' => 'form-control'),
                'label' => 'Dia 1'
            ])

            ->add('from_hour_day_one', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control'),
                'label' => 'Desde'
            ])

            ->add('to_hour_day_one', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control'),
                'label' => 'Hasta'
            ])

            //day two

            ->add('day_two', ChoiceType::class, [
                'choices' => 
                [
                    'Lunes' => 'Lunes', 
                    'Martes' => 'Martes',
                    'Miercoles' => 'Miercoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'viernes',
                    'Sabado' => 'Sabado',
                    'Domingo' => 'Domingo'
                ],
                "attr"=>array('class' => 'form-control'),
                'label' => 'Dia 2'
            ])

            ->add('from_hour_day_two', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control'),
                'label' => 'Desde'
            ])

            ->add('to_hour_day_two', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control'),
                'label' => 'Hasta'
            ])

            
            // ->add('save', SubmitType::class, array(
            //     'label' => 'Crear', 
            //     'attr'  => array('class' => 'btn btn-primary mt-3')
            // ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $schedule = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($schedule);
                $entityManager->flush();

                return $this->redirectToRoute('schedule_list');
            }

            return $this->render('schedule/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/schedule/edit/{id}", name="update_schedule")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $schedule = new Schedule();

        $schedule = $this->getDoctrine()->getRepository(Schedule::class)->find($id);

        $form = $this->createFormBuilder($schedule)
            ->add('day_one', ChoiceType::class, [
                'choices' => 
                [
                    'Lunes' => 'Lunes', 
                    'Martes' => 'Martes',
                    'Miercoles' => 'Miercoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'viernes',
                    'Sabado' => 'Sabado',
                    'Domingo' => 'Domingo'
                ],
                "attr"=>array('class' => 'form-control')
            ])

            ->add('from_hour_day_one', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control')
            ])

            ->add('to_hour_day_one', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control')
            ])

            //day two

            ->add('day_two', ChoiceType::class, [
                'choices' => 
                [
                    'Lunes' => 'Lunes', 
                    'Martes' => 'Martes',
                    'Miercoles' => 'Miercoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'viernes',
                    'Sabado' => 'Sabado',
                    'Domingo' => 'Domingo'
                ],
                "attr"=>array('class' => 'form-control')
            ])

            ->add('from_hour_day_two', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control')
            ])

            ->add('to_hour_day_two', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
                "attr"=>array('class' => 'form-control')
            ])

            // ->add('save', SubmitType::class, array(
            //     'label' => 'Actualizar', 
            //     'attr'  => array('class' => 'btn btn-primary mt-3')
            // ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
          
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('schedule_list');
            }

            return $this->render('schedule/edit.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * @Route("/schedule/{id}",  name="schedule_show")
     */
    public function show($id) {
        $schedule = $this->getDoctrine()->getRepository(Schedule::class)->find($id);

        return $this->render('schedule/show.html.twig' , array
        ('schedule' => $schedule ));
    }

    /**
     * @Route("/schedule/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $schedule = $this->getDoctrine()->getRepository
        (Schedule::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($schedule);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

     /**
     * @Route("/schedule/medic", name="schedule_medic")
     *   * @Method({"GET"})
     */
    public function medic()
    {
        $schedules = $this->getDoctrine()->getRepository(Schedule::class)->findAll();

         $response['schedules'] = $this->EntityCollectionToArrayCollection($schedules);
        //  return new Response(json_encode($response));
        return $this->render('schedule/schedule_list.html.twig' , $response);
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

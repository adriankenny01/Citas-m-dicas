<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Vacation;
use App\Classes\Helper;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\MedicGroup;

class EmployeeController extends Controller
{
    /**
     * @Route("/employee", name="employee_list")
     */
    public function index()
    {
        $employees = $this->getDoctrine()->getRepository(Employee::class)->findAll();

        return $this->render('employee/index.html.twig' , array
        ('employees' => $employees ));
    }

     /**
     * 
     * @Route("/employee/new/", name="new_employee")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $employee = new Employee();

        $form = $this->createFormBuilder($employee)
            ->add('full_name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre Completo'))
            ->add('card_id', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Cedula'))
            ->add('address', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Direccion'))
            ->add('phone', TelType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Telefono'))
            ->add('province', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Provincia'))
            ->add('image', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Foto'))
            ->add('date_start', DateType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Inicio',
            'widget' => 'single_text'))
            
            ->add('social_security', IntegerType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Seguridad Social'))
            
            ->add('tipo_empleado', ChoiceType::class, [
                'choices' => ['Auxiliares de enfermería' => 'Auxiliares de enfermería', 
                'Celadores' => 'Celadores',
                'Administrativos' => 'Administrativos',
                'ATS' => 'ATS',
                'ATS de zona' => 'ATS de zona'],
                "attr"=>array('class' => 'form-control')
            ])

            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary btn-round mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $area = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($area);
                $entityManager->flush();

                return $this->redirectToRoute('employee_list');
            }

            return $this->render('employee/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/employee/edit/{id}", name="update_employee")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $employee = new Employee();

        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);

        $form = $this->createFormBuilder($employee)
        ->add('full_name', TextType::class, array('attr' =>
        array('class' => 'form-control'), 'label' => 'Nombre Completo'))
        ->add('card_id', TextType::class, array('attr' =>
        array('class' => 'form-control'), 'label' => 'Cedula'))
        ->add('address', TextType::class, array('attr' =>
        array('class' => 'form-control'),'label' => 'Direccion'))
        ->add('phone', TelType::class, array('attr' =>
        array('class' => 'form-control'),'label' => 'Telefono'))
        ->add('province', TextType::class, array('attr' =>
        array('class' => 'form-control'),'label' => 'Provincia'))
        ->add('image', TextType::class, array('attr' =>
        array('class' => 'form-control'),'label' => 'Foto'))
        ->add('date_start', DateType::class, array('attr' =>
        array('class' => 'form-control'),'label' => 'Inicio',
        'widget' => 'single_text'))
        
        ->add('social_security', IntegerType::class, array('attr' =>
        array('class' => 'form-control'),'label' => 'Seguridad Social'))
        ->add('tipo_empleado', ChoiceType::class, [
            'choices' => ['Auxiliares de enfermería' => 'Auxiliares de enfermería', 
            'Celadores' => 'Celadores',
            'Administrativos' => 'Administrativos',
            'ATS' => 'ATS',
            'ATS de zona' => 'ATS de zona'],
            "attr"=>array('class' => 'form-control')
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

            return $this->redirectToRoute('employee_list');
        }

        return $this->render('employee/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/employee/{id}",  name="employee_show")
     */
    public function show($id) {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);

        return $this->render('employee/show.html.twig' , array
        ('employee' => $employee ));
    }

    /**
     * @Route("/employee/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $employee = $this->getDoctrine()->getRepository
        (Employee::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($employee);
        $entityManager->flush();

        $response = new Response(json_encode(["ok"]));
       $response->send();

    }


    /**
     * @Route("/employee/vacation/{id}", name="employee_vacation")
     */
    public function employee_vacation(Request $request, $id)
    {
        $employee_vacation = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        
        $vacationDays = new Helper();
        $vacationDays = $vacationDays->vacationDays( $employee_vacation->getDateStart());

        $vacationTaken = $this->vacationTaken($id); 

        return $this->render('employee/employee-vacation.html.twig' , array (
           'employee_vacation' => $employee_vacation,
           'vacationDays' => $vacationDays,
           'vacationTaken' => $vacationTaken['days_taken']
        ));
    }

    public function vacationTaken($employee_id){

        $days_taken = $this->getDoctrine()->getRepository(Vacation::class);

        if($days_taken === NULL){
            return 0;
        }else{
             $queryDaysTaken = $days_taken->createQueryBuilder('v')
                ->select("sum(v.days_taken) as days_taken")
                ->where('v.employee_id = :employee_id')
                ->setParameter('employee_id', $employee_id)
                ->getQuery()->setMaxResults(1)->getSingleResult();

            return $queryDaysTaken;
        }
    }
}

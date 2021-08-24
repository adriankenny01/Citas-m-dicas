<?php

namespace App\Controller;

use App\Entity\Medic;
use App\Entity\MedicGroup;
use App\Entity\Category;
use App\Entity\Schedule;
use App\Entity\Vacation;

use App\Repository\MedicRepository;

use App\Classes\Helper;

use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedicController extends Controller
{
    /**
     * @Route("/medic", name="medic_list")
     */
    public function index()
    {
        $medics = $this->getDoctrine()->getRepository(Medic::class)->findAll();

         $response['medics'] = $this->EntityCollectionToArrayCollection($medics);
        //  return new Response(json_encode($response));
        return $this->render('medic/index.html.twig' , $response);
    }

    /**
     * 
     * @Route("/medic/new", name="new_medic")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $medic = new Medic();

        $form = $this->createFormBuilder($medic)
            ->add('name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre'))
            ->add('last_name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Apellido'))
            ->add('address', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Direccion' ))
            ->add('phone', IntegerType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Telefono'))
            ->add('province', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Provincia'))
            ->add('card_id', IntegerType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Cédula'))
            ->add('image', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Foto'))
            ->add('social_security', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Seguridad Social'))
            ->add('number_of_collegiate', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Numero de colegiado'))
            
            ->add('MedicGroup', EntityType::class, [
                'class' => MedicGroup::class,
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($medicgroup) {
                    return $medicgroup->getName();
                },
                'label' => 'Grupo Medico'
            ])

            ->add('date_start', DateType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'label' => 'Fecha Inicio',
                'widget' => 'single_text'
            ))
            ->add('date_end', DateType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'label' => 'Fecha Fin',
                'widget' => 'single_text'
            ))
            
            ->add('category', EntityType::class, [
                'class' => Category::class, 
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($category) {
                    return $category->getArea();
                },
                'choice_attr' =>  array('class' => 'form-control'),
                'label' => 'Area medica'
            ])

            ->add('Schedule', EntityType::class, [
                'class' => Schedule::class,
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($schedule) {
                    return $schedule->getDayOne() . ' de '.$schedule->getFromHourDayOne()->format('h:i:a') . ' a '. $schedule->getFromHourDayOne()->format('h:i:a')
                    .' y '. $schedule->getDaytwo(). ' de  '.$schedule->getFromHourDayTwo()->format('h:i:a') . ' a '. $schedule->getFromHourDayTwo()->format('h:i:a')
                    ;
                },
                'label' => 'Horario'
            ])

            ->add('image', FileType::class, [
                'label' => 'Foto de perfil',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Por favor sube una imagen valida.',
                    ])
                ],
            ])
            
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $medic = $form->getData();

                $medicPhoto = $form['image']->getData();

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($medicPhoto) {
                    $originalFilename = pathinfo($medicPhoto->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$medicPhoto->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $medicPhoto->move(
                            $this->getParameter('medic_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $medic->setImage($newFilename);
                }
                
                $medic->setState(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($medic);
                $entityManager->flush();

                return $this->redirectToRoute('medic_list');
            }

            return $this->render('medic/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

     /**
     * 
     * @Route("/medic/edit/{id}", name="update_medic")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $medic = new Medic();

        $medic = $this->getDoctrine()->getRepository(Medic::class)->find($id);

        $form = $this->createFormBuilder($medic)
            ->add('name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre'))
            ->add('last_name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Apellido'))
            ->add('address', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Direccion' ))
            ->add('phone', IntegerType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Telefono'))
            ->add('province', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Provincia'))
            ->add('card_id', IntegerType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Cédula'))
            ->add('image', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Foto'))
            ->add('social_security', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Seguridad Social'))
            ->add('number_of_collegiate', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Execuatur'))
            ->add('image', FileType::class, [
                'label' => false,
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Por favor sube una imagen valida.',
                    ])
                ],
            ])
            ->add('MedicGroup', EntityType::class, [
                'class' => MedicGroup::class,
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($medicgroup) {
                    return $medicgroup->getName();
                },
                'label' => 'Grupo Medico'
            ])

            ->add('date_start', DateType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                ),
                'label' => 'Fecha Inicio',
                'widget' => 'single_text'
            ))
            ->add('date_end', DateType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required'  => false
                ),
                'label' => 'Fecha Fin',
                'widget' => 'single_text'
            ))
            
            ->add('category', EntityType::class, [
                'class' => Category::class, 
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($category) {
                    return $category->getArea();
                },
                'choice_attr' =>  array('class' => 'form-control'),
                'label' => 'Area medica'
            ])

            ->add('Schedule', EntityType::class, [
                'class' => Schedule::class,
                "attr"=>array('class' => 'form-control'),
                'choice_label' => function ($schedule) {
                    return $schedule->getDayOne() . ' de '.$schedule->getFromHourDayOne()->format('h:i:a') . ' a '. $schedule->getFromHourDayOne()->format('h:i:a')
                    .' y '. $schedule->getDaytwo(). ' de  '.$schedule->getFromHourDayTwo()->format('h:i:a') . ' a '. $schedule->getFromHourDayTwo()->format('h:i:a')
                    ;
                },
                'label' => 'Horario'
            ])

          

            ->add('save', SubmitType::class, array(
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $medicPhoto = $form['image']->getData();

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($medicPhoto) {
                    $originalFilename = pathinfo($medicPhoto->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$medicPhoto->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $medicPhoto->move(
                            $this->getParameter('medic_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $medic->setImage($newFilename);
                }
                $medic->setState(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('medic_list');
            }

            return $this->render('medic/edit.html.twig', array(
                'form' => $form->createView(),
                'image'     => $medic->getImage(),
                'full_name'    => $medic->getName(),
                'category'  => $medic->getCategory()->getArea()
            ));
    }

    /**
     * @Route("/medic/{id}",  name="medic_show")
     */
    public function show($id) {

        $em = $this->getDoctrine()->getManager();
        $medic = $em->getRepository('App:Medic')
            ->showMedic($id);

            // var_dump($medic);die;
        return $this->render('medic/show.html.twig' , array (
            'medic' => $medic
        ));
        
    }

    /**
     * @Route("/medic/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $medic = $this->getDoctrine()->getRepository
        (Medic::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($medic);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/medic/schedule/list", name="medic_schedule")
     */
    public function medic_schedule()
    {
        $medics = $this->getDoctrine()->getRepository(Medic::class)->findAll();

         $response['schedules'] = $this->EntityCollectionToArrayCollection($medics);
        //  var_dump($response);die;
        //  return new Response(json_encode($response));
        return $this->render('medic/listing.html.twig' , $response);
    }


    /**
     * @Route("/medic/vacation/{id}", name="medic_vacation")
     */
    public function medic_vacation(Request $request, $id)
    {
        $medic_vacation = $this->getDoctrine()->getRepository(Medic::class)->find($id);
        
        $vacationDays = new Helper();
        $vacationDays = $vacationDays->vacationDays($medic_vacation->getDateStart());

        $vacationTaken = $this->vacationTaken($id); 

        return $this->render('medic/medic-vacation.html.twig' , array (
           'medic_vacation' => $medic_vacation,
           'vacationDays' => $vacationDays,
           'vacationTaken' => $vacationTaken['days_taken']
        ));
    }

    public function vacationTaken($medic_id){

        $days_taken = $this->getDoctrine()->getRepository(Vacation::class);

        if($days_taken === NULL){
            return 0;
        }else{
             $queryDaysTaken = $days_taken->createQueryBuilder('v')
                ->select("sum(v.days_taken) as days_taken")
                ->where('v.medic_id = :medic_id')
                ->setParameter('medic_id', $medic_id)
                ->getQuery()->setMaxResults(1)->getSingleResult();

            return $queryDaysTaken;
        }
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

<?php

namespace App\Controller;

use App\Entity\Patient;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PatientController extends Controller
{

    /**
     * @Route("/patient", name="patient_list")
     */
    public function index()
    {
        $patients = $this->getDoctrine()->getRepository(Patient::class)->findAll();

        return $this->render('patient/index.html.twig' , array
        ('patients' => $patients ));
    }

    /**
     * 
     * @Route("/patient/new", name="new_patient")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $patient = new Patient();

        $form = $this->createFormBuilder($patient)
            ->add('full_name', TextType::class, array('label' => false,'attr' =>
                array(
                    'class' => 'form-control', 
                    'placeholder' => 'Nombre Completo', 
                    )
                ))
            ->add('email', EmailType::class, array('attr' =>
            array( 'placeholder' => 'Correo' , 'class' => 'form-control'), 'label' => false))
            ->add('card_id', TextType::class, array('attr' =>
            array('placeholder' => 'Cédula', 'class' => 'form-control'),'label' => false))
            ->add('address', TextType::class, array('attr' =>
            array('placeholder' => 'Dirección','class' => 'form-control'),'label' => false))
            
            ->add('username', TextType::class, array('attr' =>
            array('placeholder' => 'Nombre de usuario','class' => 'form-control'),'label' => false))
            
            ->add('password', PasswordType::class, array('attr' =>
            array('placeholder' => 'Contrasena','class' => 'form-control'),'label' => false))
                    
            ->add('phone', TextType::class, array('attr' =>
            array('placeholder' => 'Télefono', 'class' => 'form-control'),'label' => false))
            ->add('photo', FileType::class, [
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
            ->add('social_security', IntegerType::class, 
                array(
                    'attr' =>
                        array(
                            'class' => 'form-control',
                            'placeholder' => 'Seguridad Social'
                        ),
                    'label' => false
                    )
                )
            
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $patient = $form->getData();

                $patientPhoto = $form['photo']->getData();

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($patientPhoto) {
                    $originalFilename = pathinfo($patientPhoto->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$patientPhoto->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $patientPhoto->move(
                            $this->getParameter('patient_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $patient->setPhoto($newFilename);
                }

                $patient->setPassword(
                    password_hash( $patient->getPassword() , PASSWORD_BCRYPT ) 
                );

                $patient->setState(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($patient);
                $entityManager->flush();

                return $this->redirectToRoute('patient_list');
            }

            return $this->render('patient/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/patient/edit/{id}", name="update_patient")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $patient = new Patient();

        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);

        $form = $this->createFormBuilder($patient)
            ->add('full_name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre Completo'))
            ->add('email', EmailType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Email'))
            ->add('card_id', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Cedula'))
            ->add('address', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Direccion'))
            ->add('phone', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Telefono'))
            ->add('social_security', IntegerType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Seguridad Social'))
            ->add('photo', FileType::class, [
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
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $patientPhoto = $form['photo']->getData();

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($patientPhoto) {
                    $originalFilename = pathinfo($patientPhoto->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$patientPhoto->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $patientPhoto->move(
                            $this->getParameter('patient_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $patient->setPhoto($newFilename);
                }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('patient_list');
            }

            return $this->render('patient/edit.html.twig', array(
                'form'      => $form->createView(),
                'full_name' => $patient->getFullName(),
                'photo'     => $patient->getPhoto()
            ));
    }

    /**
     * @Route("/patient/{id}",  name="patient_show")
     */
    public function show($id) {
        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);

        return $this->render('patient/show.html.twig' , array
        ('patient' => $patient ));
    }

    /**
     * @Route("/patient/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($patient);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}

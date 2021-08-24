<?php 

namespace App\Controller;

use App\Entity\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends Controller{
    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    /**
     * @Route("/user/", name="user_list")
     * 
     */
    public function index(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('users/index.html.twig' , array
        ('users' => $users ));
    }

    /**
     * @Route("/profile/", name="profile")
     * 
     */
    public function profile(){

        return $this->render('users/profile.html.twig' , [

        ]);
    }

    /**
     * 
     * @Route("/user/new", name="new_user")
     * Method({"GET", "POST"})
     */

    public function new (Request $request) {
        $user = new User($this->encoder);

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => 'Nombre',
                    
                ) ,'label' => false
            ))
            ->add('username', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => 'Nombre de Usuario',
                    
                ) ,'label' => false
            ))
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => 'Email',
                    
                ) ,'label' => false
            ))
            ->add('password', PasswordType::class, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => 'Contrasena',
                    
                ) ,'label' => false
            ))
            
            ->add('save', SubmitType::class, array(
                'label' => 'Crear', 
                'attr'  => array('class' => 'btn-lg btn-primary btn-block mt-4')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $user = $form->getData();

                $user->setPassword(
                    $this->encoder->encodePassword($user, $user->getPassword())
                );

                $user->setState(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                
                return $this->redirectToRoute('user_list');
            }

            return $this->render('users/new.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * 
     * @Route("/user/edit/{id}", name="update_user")
     * Method({"GET", "POST"})
     */

    public function edit (Request $request, $id) {
        $user = new User($this->encoder);

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Nombre'))
            ->add('username', TextType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'Usuario'))
            ->add('email', EmailType::class, array('attr' =>
            array('class' => 'form-control'),'label' => 'E-mail'))
            ->add('password', PasswordType::class, array('attr' =>
            array('class' => 'form-control'), 'label' => 'Contrasena'))
            
            ->add('save', SubmitType::class, array(
                'label' => 'Actualizar', 
                'attr'  => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                $user->setPassword(
                    $this->encoder->encodePassword($user, $user->getPassword())
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('user_list');
            }

            return $this->render('users/edit.html.twig', array(
                'form' => $form->createView()
            ));
    }

    /**
     * @Route("/user/{id}",  name="user_show")
     */
    public function show($id) {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('users/show.html.twig' , array
        ('user' => $user ));
    }

    /**
     * @Route("/user/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $user = $this->getDoctrine()->getRepository
        (User::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

}
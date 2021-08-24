<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255 ,unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string" ,length=255 ,unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", length=1)
    */
    private $state;

    /**
     * @ORM\Column(type="string" ,length=255 ,unique=true)
     */
    private $type;

       /**
     * @var UploadedFile
     * @ORM\Column(type="string")
    */
    private $photo;

    /**
     * @ORM\Column(type="integer", length=1)
    */
    private $patient_id;

    /**
     * @ORM\Column(type="string" ,length=255 ,unique=true)
     */
    private $role;


    // Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
       $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
       $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
       $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
       $this->password = $password;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
       $this->type = $type;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getPatientId()
    {
        return $this->patient_id;
    }

    public function setPatientId($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRoles(){
        return [
            'ROLE_USER',
            'ROLE_PATIENT',
            'ROLE_EMPLOYEE',
            'ROLE_MEDIC',
            'ROLE_APPOINTMENTS',
            'ROLE_SCHEDULES',
            'ROLE_ADMIN'
        ];
    }

    public function getSalt() {}

    public function eraseCredentials() {}

    public function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' =>  false]);
    }

}

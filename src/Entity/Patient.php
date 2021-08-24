<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 *  @UniqueEntity(
 *     fields={"full_name", "email", "phone" ,"card_id", "social_security"},
 *     message="Ya se ha registrado este campo."
 * )
 */
class Patient 
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=200)
     */
    private $full_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

     /**
     * @ORM\Column(type="text")
     */
    
    private $card_id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $address;

    /**
     * @ORM\Column(type="integer" ,length=20)
     */
    
    private $phone;

    /**
     * @var UploadedFile
     * @ORM\Column(type="string")
    */
    
    private $photo;

    /**
     * @ORM\Column(type="integer" ,length=10)
     */
    
    private $social_security;

    /**
     * @ORM\Column(type="integer" ,length=1 )
     */
    
    private $state;

    
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

     //Relations

    /**
     * @ORM\OneToMany(targetEntity="Appoinment", mappedBy="Patient")
     */
    private $appoinments;

    public function getAppoinment()
    {
        return $this->appoinments;
    }

    public function addAppoinment($appoinment)
    {
        $this->appoinments [] = $appoinment;
        return $this;
    }

    public function removeAppoinment($medic)
    {
        $this->medics->removeElement($medic);
        return $this;
    }

    

    //Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCardId()
    {
        return $this->card_id;
    }

    public function setCardId($card_id)
    {
        $this->card_id = $card_id;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setZipCode($zip_code)
    {
        $this->zip_code = $zip_code;
    }

    public function getNif()
    {
        return $this->nif;
    }

    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    public function getSocialSecurity()
    {
        return $this->social_security;
    }

    public function setSocialSecurity($social_security)
    {
        $this->social_security = $social_security;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
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

}

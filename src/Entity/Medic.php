<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicRepository")
 *  @UniqueEntity(
 *     fields={"social_security", "schedule_id"},
 *      message="Ya se ha registrado este campo."
 *  )
 */

class Medic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $last_name;

    /**
     * @ORM\Column(type="text", length=200)
     */
    private $address;

     /**
     * @ORM\Column(type="integer")
     */
    
    private $phone;
    
    /**
     * @ORM\Column(type="text")
     */
    
    private $province;

     /**
     * @ORM\Column(type="string", length=50)
     */
    
    private $card_id;

     /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $social_security;

     /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $number_of_collegiate;

    /**
     * @ORM\Column(type="integer")
     */
    
    private $schedule_id;
    
    /**
     * @ORM\OneToOne(targetEntity="Schedule", inversedBy="medics")
     * @ORM\JoinColumn(name="schedule_id", referencedColumnName="id")
     */
    private $schedule;


    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
        return $this;
    }
    

    /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $group_id;


    public function getGroup_id()
    {
        return $this->group_id;
    }

    public function setGroup_id($group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }


    /**
     * @ORM\ManyToOne(targetEntity="MedicGroup", inversedBy="medics")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */

    private $MedicGroup;


    public function getMedicGroup()
    {
        return $this->MedicGroup;
    }

    public function setMedicGroup($MedicGroup)
    {
        $this->MedicGroup = $MedicGroup;
        return $this;
    }

    /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $state;

   /**
     * @var UploadedFile
     * @ORM\Column(type="string")
    */
    private $image;


    /**
     * @ORM\Column(type="date")
     */
    
    private $date_start;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $date_end;

    /**
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="medics")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    //Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFullName(){
        return $this->name . $this->last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
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

    public function getProvince()
    {
        return $this->province;
    }

    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function getCardId()
    {
        return $this->card_id;
    }

    public function setCardId($card_id)
    {
        $this->card_id = $card_id;
    }

    public function getSocialSecurity()
    {
        return $this->social_security;
    }

    public function setSocialSecurity($social_security)
    {
        $this->social_security = $social_security;
    }

    public function getNumberOfCollegiate()
    {
        return $this->number_of_collegiate;
    }

    public function setNumberOfCollegiate($number_of_collegiate)
    {
        $this->number_of_collegiate = $number_of_collegiate;
    }

    public function getDaysOfConsulting()
    {
        return $this->days_of_consulting;
    }

    public function setDaysOfConsulting($days_of_consulting)
    {
        $this->days_of_consulting = $days_of_consulting;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getDateStart()
    {
        return $this->date_start;
    }

    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
    }

    public function getDateEnd()
    {
        return $this->date_end;
    }

    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
    }

    public function getcategory_id()
    {
        return $this->category_id;
    }

    public function setcategory_id($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
    }

    public function getScheduleId() {
        return $this->schedule_id;
    }

    public function setScheduleId($schedule_id) {
       $this->schedule_id = $schedule_id;
    }


    /**
     *  Get Array Serializtion
     */

     public function toArray(){
         return array (
            'id' => $this->getID(),
           'name' => $this->getName() ,
           'last_name' => $this->getLastName(),
           'full_name' => $this->getName() . $this->getLastName(),
           'address' => $this->getAddress(),
           'phone' => $this->getPhone(),
           'province' => $this->getProvince(),
           'card_id'  => $this->getCardId(),
           'date_start' => $this->getDateStart(),
           'date_end' => $this->getDateEnd(),
           'image' => $this->getImage(),
           'category' => $this->getCategory()->getArea(),
           'medic_group' => $this->getMedicGroup()->getName(),
           'schedule' => $this->getSchedule(),
           'state' => $this->getState(),
         );
     }

     //Relation from appoinment

     /**
     * @ORM\OneToMany(targetEntity="Appoinment", mappedBy="Medic")
     */
    private $appoinments;

    public function getAppoinments()
    {
        return $this->appoinments;
    }

    public function addAppoinments($appoinments)
    {
        $this->appoinments [] = $appoinments;
        return $this;
    }

    public function removeAppoinments($appoinments)
    {
        $this->appoinments->removeElement($appoinments);
        return $this;
    }

     /**
     * @ORM\OneToMany(targetEntity="Vacation", mappedBy="Medic")
     */
    private $vacations;

    public function getvacations()
    {
        return $this->vacations;
    }

    public function addvacations($vacations)
    {
        $this->vacations [] = $vacations;
        return $this;
    }

    public function removevacations($vacations)
    {
        $this->vacations->removeElement($vacations);
        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppoinmentRepository")
 */
class Appoinment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
    */

    private $medic_id;

     /**
     * @ORM\Column(type="integer")
    */

    private $patient_id;

    /**
     * @ORM\Column(type="date")
    */

    private $start;

    /**
     * @ORM\Column(type="date")
    */

    private $end;

    /**
     * @ORM\Column(type="text" ,length=100)
    */

    private $title;

    /**
     * @ORM\Column(type="text", length=200)
    */

    private $symptoms;

    /**
     * @ORM\Column(type="text", length=200)
    */

    private $medicaments;

    /**
     * @ORM\Column(type="text", length=200)
    */

    private $sick;
    
      /**
     * @ORM\Column(type="text", length=100)
    */

    private $url = '/appointment/edit/';
    

    /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $state;

    //Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function get_MedicId()
    {
        return $this->medic_id;
    }

    public function set_MedicId($medic_id)
    {
        $this->medic_id = $medic_id;
    }

    public function set_PatientId($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function get_PatientId()
    {
        return $this->patient_id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart($start) {
        $this->start = $start;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd($end) {
        $this->end = $end;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getSymptoms()
    {
        return $this->symptoms;
    }

    public function setSymptoms($symptoms)
    {
        $this->symptoms = $symptoms;
    }

    public function getMedicaments()
    {
        return $this->medicaments;
    }

    public function setMedicaments($medicaments)
    {
        $this->medicaments = $medicaments;
    }

    public function getSick()
    {
        return $this->sick;
    }

    public function setSick($sick)
    {
        $this->sick = $sick;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url = '/appointment/edit/')
    {
        $this->url = $url;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
    }

    //Relations
    
    /**
     * @ORM\ManyToOne(targetEntity="Medic", inversedBy="appoinments")
     * @ORM\JoinColumn(name="medic_id", referencedColumnName="id")
     */

    private $Medic;

    public function getMedic()
    {
        return $this->Medic;
    }

    public function setMedic($Medic)
    {
        $this->Medic = $Medic;
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="appoinments")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id")
     */

    private $Patient;

    public function getPatient()
    {
        return $this->Patient;
    }

    public function setPatient($Patient)
    {
        $this->Patient = $Patient;
        return $this;
    }

     /**
     *  Get Array Serializtion
     */

    public function toArray(){
        return array (
           'id' => $this->getID(),
          'title' => $this->getTitle(),
          'symptoms' => $this->getSymptoms(),
          'medicaments'  => $this->getMedicaments(),
          'sick'  => $this->getSick(),
          'start' => $this->getStart()->format('Y-m-d'),
          'end' => $this->getEnd()->format('Y-m-d'),
          'patient_name' => $this->getPatient()->getFullName(),
          'medic_name' => $this->getMedic()->getName(),
          'url' => $this->getUrl(),
          'state' => $this->getState()
        );
    }
}

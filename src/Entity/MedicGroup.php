<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicGroupRepository")
 *   @UniqueEntity(
 *     fields={"name"},
 *     message="Ya se ha registrado este grupo."
 * )
 */
class MedicGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true )
     */
    private $name;

    /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $state;



    /**
     * @ORM\OneToMany(targetEntity="Medic", mappedBy="MedicGroup")
     */
    private $medics;

    public function getMedics()
    {
        return $this->medics;
    }

    public function addMedics($medics)
    {
        $this->medics [] = $medics;
        return $this;
    }

    public function removeMedics($medics)
    {
        $this->medics->removeElement($medics);
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

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
    }
}

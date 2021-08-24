<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @UniqueEntity(
 *     fields={"area"},
 *     message="Ya se ha registrado esta area."
 * )
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $area;

    /**
     * @ORM\Column(type="string")
     */
    public $icon;

    /**
     * @ORM\Column(type="integer" ,length=1)
     */
    
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="Medic", mappedBy="category")
     */
    private $medics;

    public function getMedics()
    {
        return $this->medics;
    }

    public function addMedics($medic)
    {
        $this->medics [] = $medic;
        return $this;
    }

    public function removeMedics($medic)
    {
        $this->medics->removeElement($medic);
        return $this;
    }

    

    //Getters & Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
       $this->state = $state;
    }
}

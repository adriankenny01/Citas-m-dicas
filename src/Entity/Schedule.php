<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 *  @UniqueEntity(
 *     fields={"day_one", "day_two", "from_hour_day_one", "to_hour_day_one", "from_hour_day_two", "to_hour_day_two"},
 *     message="Ya se ha registrado este grupo."
 * )
 */
class Schedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string" ,length=255)
     */

    private $day_one;

      /**
     * @ORM\Column(type="string" ,length=255)
     */

    private $day_two;

    /**
     * @ORM\Column(type="time")
     */

    private $from_hour_day_one;

    /**
    * @ORM\Column(type="time")
    */

    private $to_hour_day_one;

    /**
     * @ORM\Column(type="time")
     */

    private $from_hour_day_two;

    /**
    * @ORM\Column(type="time")
    */

    private $to_hour_day_two;

    /**
   * @ORM\Column(type="integer" , length=1)
   */
    
    private $state;

    //getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayOne()
    {
        return $this->day_one;
    }

    public function setDayOne($day_one)
    {
        $this->day_one = $day_one;
    }

    public function getDayTwo()
    {
        return $this->day_two;
    }

    public function setDayTwo($day_two)
    {
        $this->day_two = $day_two;
    }

    public function getFromHourDayOne()
    {
        return $this->from_hour_day_one;
    }

    public function setFromHourDayOne($from_hour_day_one)
    {
        $this->from_hour_day_one = $from_hour_day_one;
    }

    public function getToHourDayOne()
    {
        return $this->to_hour_day_one;
    }

    public function setToHourDayOne($to_hour_day_one)
    {
        $this->to_hour_day_one = $to_hour_day_one;
    }

    //Day TWO
    
    public function getFromHourDayTwo()
    {
        return $this->from_hour_day_two;
    }

    public function setFromHourDayTwo($from_hour_day_two)
    {
        $this->from_hour_day_two = $from_hour_day_two;
    }

    public function getToHourDayTwo()
    {
        return $this->to_hour_day_two;
    }

    public function setToHourDayTwo($to_hour_day_two)
    {
        $this->to_hour_day_two = $to_hour_day_two;
    }




    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    //Relations

    /**
     * @ORM\OneToMany(targetEntity="Medic", mappedBy="Schedule")
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

}

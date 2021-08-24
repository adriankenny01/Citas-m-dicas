<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VacationRepository")
 */
class Vacation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $days_taken;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observations;

    /**
     * @ORM\Column(type="date")
     */
    private $date_init;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $employee_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $medic_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDaysTaken(): ?int
    {
        return $this->days_taken;
    }

    public function setDaysTaken(?int $days_taken): self
    {
        $this->days_taken = $days_taken;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getDateInit()
    {
        return $this->date_init;
    }

    public function setDateInit($date_init)
    {
        $this->date_init = $date_init;

        return $this;
    }

    // public function getDateInit(): ?string
    // {
    //     return $this->date_init;
    // }

    // public function setDateInit(?string $date_init): self
    // {
    //     $this->date_init = $date_init;

    //     return $this;
    // }

    public function getEmployeeId(): ?int
    {
        return $this->employee_id;
    }

    public function setEmployeeId(?int $employee_id): self
    {
        $this->employee_id = $employee_id;

        return $this;
    }

    public function getMedicId(): ?int
    {
        return $this->medic_id;
    }

    public function setMedicId(?int $medic_id): self
    {
        $this->medic_id = $medic_id;

        return $this;
    }

    // /**
    //  * @ORM\ManyToOne(targetEntity="Employee", inversedBy="vacation")
    //  * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
    //  */
    // private $employee;


    // public function getEmployee()
    // {
    //     return $this->employee;
    // }

    // public function setEmployee($employee)
    // {
    //     $this->employee = $employee;
    //     return $this;
    // }

    /**
     * @ORM\ManyToOne(targetEntity="Medic", inversedBy="vacation")
     * @ORM\JoinColumn(name="medic_id", referencedColumnName="id")
     */
    private $medic;


    public function getMedic()
    {
        return $this->medic;
    }

    public function setMedic($medic)
    {
        $this->medic = $medic;
        return $this;
    }
}

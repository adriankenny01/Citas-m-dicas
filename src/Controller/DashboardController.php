<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Employee;
use App\Entity\Patient;
use App\Entity\Appoinment;
use App\Entity\Medic;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        $employee = $this->countEmployee();
        $patient = $this->countPatient();
        $appoinment = $this->countAppoinment();
        $medic = $this->countMedic();

        return $this->render('dashboard/index.html.twig', [
            'employee'  => $employee ,
            'patient'   => $patient,
            'appoinment'   => $appoinment,
            'medic'   => $medic
        ]);
    }

    private function countMedic(){
        $medic = $this->getDoctrine()->getRepository(Medic::class)->countAll();

        return $medic;
    }

    private function countAppoinment(){
        $appoinment = $this->getDoctrine()->getRepository(Appoinment::class)->countAll();

        return $appoinment;
    }

    private function countEmployee(){
        $employee = $this->getDoctrine()->getRepository(Employee::class)->countAll();

        return $employee;
    }

    private function countPatient(){
        $patient = $this->getDoctrine()->getRepository(Patient::class)->countAll();

        return $patient;
    }
}

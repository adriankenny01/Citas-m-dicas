<?php

namespace App\Classes;

class Helper {
    
    public function vacationDays($date){
        
        $date_current = new \DateTime();
        $date_init = $date;
        $difference = $date_current->diff($date_init);
        $year_difference = $difference->format('%y');
        $vacation_days = 0;
        if($year_difference <= 5){
            $vacation_days = $year_difference*15;
        }elseif($year_difference > 5 && $year_difference <= 10){
            $vacation_days = 75+($year_difference-5)*20;
        }elseif($year_difference > 10){
            $vacation_days = 75+100+($year_difference-10)*30;
        }
        return $vacation_days;
    }

    public function mailer($name, \Swift_Mailer $mailer)
    {
        // $message = (new \Swift_Message('Hello Email'))
        //     ->setFrom('send@example.com')
        //     ->setTo('recipient@example.com')
        //     ->setBody(
        //         $this->renderView(
        //             // templates/emails/registration.html.twig
        //             'emails/registration.html.twig',
        //             ['name' => $name]
        //         ),
        //         'text/html'
        //     )

        //     // you can remove the following code if you don't define a text version for your emails
        //     ->addPart(
        //         $this->renderView(
        //             'emails/registration.txt.twig',
        //             ['name' => $name]
        //         ),
        //         'text/plain'
        //     )
        // ;

        // $mailer->send($message);

        // return $this->render(...);
    }

}
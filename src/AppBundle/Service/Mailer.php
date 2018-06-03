<?php
/**
 * Created by PhpStorm.
 * User: vilca
 * Date: 02/06/18
 * Time: 20:08
 */

namespace AppBundle\Service;


class Mailer
{
    private $mail;
    private $templating;
    private $from = 'Reservation@flyaround.com';


    public function __construct(\Swift_Mailer $mail, \Twig_Environment $templating)
    {
        $this->mail = $mail;
        $this->templating = $templating;
    }

    /**
     * @param $mailTo
     * @param $subject
     * @param $data
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendMail($mailTo, $subject, $data)
    {
        $message = (new \Swift_Message)
            ->setFrom($this->from)
            ->setTo($mailTo)
            ->setSubject($subject)
            ->setBody($this->templating->render(
                'email/contact.html.twig', ['data'=> $data]), 'text/html');
        $this->mail->send($message);
    }
}
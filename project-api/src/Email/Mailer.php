<?php


namespace App\Email;


use App\Entity\User;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig\Environment
     */
    private $twig;
function __construct(\Swift_Mailer $mailer, \Twig\Environment $twig)
{
    $this->mailer=$mailer;
    $this->twig=$twig;
}
public function sendMail(User $user){
    $body=$this->twig->render(
        'email/confirmation.html.twig',
        [
            'user'=>$user
        ]
    );
    $message=(new \Swift_Message('Please confirm your account!'))
        ->setTo($user->getEmail())
        ->setFrom("prosperityproject@api-platform")
        ->setBody($body, 'text/html');
    $this->mailer->send($message);
}
}
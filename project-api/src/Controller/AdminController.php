<?php


namespace App\Controller;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController as BaseAdminController;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;


class AdminController extends BaseAdminController
{
    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;

    function __construct(PasswordEncoderInterface $encoder)
    {

        $this->encoder = $encoder;
    }
    

}
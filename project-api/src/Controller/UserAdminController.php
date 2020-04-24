<?php


namespace App\Controller;
use App\Entity\User;

use App\Entity\UserProfileImages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController as BaseAdminController;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserAdminController extends BaseAdminController
{
    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;

    function __construct( UserPasswordEncoderInterface $encoder)
    {

        $this->encoder = $encoder;
    }

    /**
     * @param User $entity
     */
    protected function persistEntity($entity)
    {
        $this->encodeUserPassword($entity);


    }


    /**
     * @param User $entity
     */
    protected function updateEntity($entity)
    {
        $this->encodeUserPassword($entity);

    }

    /**
     * @param User $entity
     */
    private function encodeUserPassword(User $entity): void
    {
        $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
    }



}
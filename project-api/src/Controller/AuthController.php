<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();


        $username = $request->request->get("email");
        $password = $request->request->get("password");
        $name=$request->request->get("name");
        $career=$request->request->get("careerobjs");
        $sex=$request->request->get("sex");
        $dob=$request->request->get("dob");
        $d=strtotime($dob);
        $d=date("Y-m-d H:i:s",$d);
        try {
            $d = new \DateTime($d);
        } catch (\Exception $e) {
            $e->getMessage();
        }

        $desig=$request->request->get('designation');
        $phone=$request->request->get("phone");
        $role=$request->request->get("role");
        //$isActive=$request->request->get("is_active");

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setName($name);
        $user->setCareerobjs($career);
        $user->setSex($sex);
        $user->setDob($d);
        $user->setDesignation($desig);
        $user->setPhone($phone);
        $user->setRoles(array($role));
        //$user->setIsActive($isActive);


        $em->persist($user);
        $em->flush();
$rol=$user->getUsername();
        //return new Response(sprintf('User %s successfully created', print_r($rol)));
        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}
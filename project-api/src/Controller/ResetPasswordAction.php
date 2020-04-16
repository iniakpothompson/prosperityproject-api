<?php
//
//
//namespace App\Controller;
//
//use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
//use Symfony\Component\Validator\Constraints as Assert;
//use ApiPlatform\Core\Validator\ValidatorInterface;
//use App\Entity\User;
//use Doctrine\ORM\EntityManager;
//use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordAction
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var JWTTokenManagerInterface
     */
    private $tokenManager;

    public function __construct(
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $entityManager,
        JWTTokenManagerInterface $tokenManager
    )
    {
        $this->validator = $validator;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->tokenManager = $tokenManager;
    }

    public function __invoke(User $data)
    {
        // $reset = new ResetPasswordAction();
        // $reset();
//        var_dump(
//            $data->getNewPassword(),
//            $data->getNewRetypedPassword(),
//            $data->getOldPassword(),
//            $data->getRetypedPassword()
//        );
//        die;
        $context['groups'] = ['put-reset-password'];
        $this->validator->validate($data, $context);
        //$this->validator->validate($data);

        $data->setPassword(
            $this->userPasswordEncoder->encodePassword(
                $data, $data->getNewPassword()
            )
        );
        // After password change, old tokens are still valid
        //$context['groups'] = ['put-reset-password'];
       $data->setPasswordChangeDate(time());

        $this->entityManager->flush();

        $token = $this->tokenManager->create($data);

        return new JsonResponse(['token' => $token]);

        // Validator is only called after we return the data from this action!
        // Only hear it checks for user current password, but we've just modified it!

        // Entity is persisted automatically, only if validation pass
    }
}

//class ResetPasswordAction
//{
//    private  $val;
//    private $userPasswordEncoder;
//    private $entityManager;
//    private $tokenManager;
//    function __construct(ValidatorInterface $val,
//                            UserPasswordEncoderInterface $passwordEncoder,
//                            EntityManagerInterface $entityManager, JWTTokenManagerInterface $tokenManager
//                        )
//    {
//        $this->val=$val;
//        $this->userPasswordEncoder=$passwordEncoder;
//        $this->entityManager=$entityManager;
//        $this->tokenManager=$tokenManager;
//    }
// function __invoke(User $data)
//   {
//       //var_dump($data->getNewPassword(),$data->getNewRetypedPassword(),$data->getOldPassword()); die();
//       //$context['groups'] = ['put-reset-password'];
//       $passConstraint=new Assert\Regex(["pattern"=>"/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/", "message"=>"Password must be at least seven characters long and contain at least one digit, one uppercase letter","groups"=>"put-reset-password"]);
//       $retypedPassConstraint= new Assert\Expression([$data->getNewPassword()==$data->getNewRetypedPassword(),"message"=>"Passwords Does not Match typed password","groups"=>"put-reset-password"]);
//       $err= $this->val->validate($data,[$passConstraint, $retypedPassConstraint],null,);
////       $this->val->validate($data->getOldPassword());
//       $data->setNewPassword($this->userPasswordEncoder->encodePassword($data,$data->getNewPassword()));
//       //$err=$this->val->validate($data);
//
//       $this->entityManager->flush();
//
//       $token=$this->tokenManager->create($data);
//       //return new JsonResponse(['token'=>$token, 'error'=>$err]);
//     //return new JsonResponse(['newpassword'=>$data->getNewRetypedPassword(), 'error'=>$err]);
//
// }
//}
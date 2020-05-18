<?php


namespace App\Security;


use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\PreAuthenticationJWTUserToken;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class TokenAuthenticator extends JWTTokenAuthenticator
{
    /**
     * @param PreAuthenticationJWTUserToken $preAuthToken
     * @param UserProviderInterface $userProvider
     * @return \Symfony\Component\Security\Core\User\UserInterface|void|null
     */
    public function getUser($preAuthToken, UserProviderInterface $userProvider)
        {
            /**
             * @var User $user
             */
            $user= parent::getUser($preAuthToken, $userProvider);
            //var_dump($preAuthToken->getPayload()); die;
            if($user->getPasswordChangeDate() && $preAuthToken->getPayload()['iat']<$user->getPasswordChangeDate()){
                throw new ExpiredTokenException();
            }
            return $user;
        }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return \Symfony\Component\HttpFoundation\Response|void|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        //$user=$this->getUser();

        return parent::onAuthenticationSuccess($request, $token, $providerKey);
        //var_dump($user);
    }

}
<?php


namespace App\EventSubscriber;


use App\Entity\MinistryImage;
use App\Entity\User;
use App\Repository\MinistriesRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationSuccessEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var MinistriesRepository
     */
    private $minRepo;

    public function __construct(MinistriesRepository $minRepo)
{
    $this->minRepo = $minRepo;
}

    public static function getSubscribedEvents()
    {
        return[
            Events::AUTHENTICATION_SUCCESS=>'onAuthenticationSuccess',
            Events::AUTHENTICATION_FAILURE=>'onAuthenticationFailure'

        ];
    }
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $evt){
//        $request = $event->getRequest();
//        $method = $request->getMethod();
//        $route = $request->get('_route');
//        if (!in_array($method, [Request::METHOD_POST]) ||
//            !in_array($request->getContentType(), ['html', 'form','json', 'jsonld']) ) {
//            return;
//        }
        $user=$evt->getUser();
        $data=$evt->getData();
        if(!$user instanceof User){
            return;
        }

        $user_id=$user->getId();

        $findmin=$this->minRepo->findOneByUser($user_id);
        if($findmin===null){
            return;
        }
        $ministryimg=$findmin->getImage()->getFilePath();
        $ministryId=$findmin->getId();
        $ministryName=$findmin->getName();

        if(($ministryimg===null)||($ministryId===null)||($ministryName===null)){
            return;
        }

        $role=$user->getRoles();
        $name=$user->getName();
        $profileimg=$user->getImage()->getFilePath();
        $profileimg=preg_replace('/\//', '/', $profileimg);


        $data['data']=array('User_name'=>$name,'user_id'=>$user_id,'role'=>$role);
        $data['data']+=array('profile_img'=>$profileimg);
        $data['data']+= ['MinistryName' => $ministryName];
        $data['data']+= ['ministryId' => $ministryId];
        $data['data']+= ['ministryimg' => $ministryimg];

//        $this->addData("user_id",$user_id);
//        $this->addData("role",$role);
//        $this>$this->addData("Name",$name);
//        $this>$this->addData("profileimg",$profileimg);
//        $this>$this->addData("ministryName",$ministryName);
//        $this>$this->addData("ministryimg",$ministryimg);
//        $this->addData("ministryId",$ministryId);
        //var_dump($data);
//        $data['data']=array(
//            'roles'=>$user->getRoles(),
//            'name'=>$user->getName(),
//            'profile_image'=>,
//            'ministry'=>$minname,
//            'ministry_id'=>$findmin->getId(),
//            'ministry_img_id'=>$findmin->getImage()->getFilePath()
//
//
//        );
        $evt->setData($data);

    }

    public function onAuthenticationFailure(AuthenticationFailureEvent $event)
    {
        $data = [
            'status'  => '401 Unauthorized',
            'message' => 'Bad credentials, please verify that your username and password are correct'
        ];

        $response = new JWTAuthenticationFailureResponse($data);

        $event->setResponse($response);
    }
}
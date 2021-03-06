<?php

namespace App\Controller;

use App\Entity\ProjectImages;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateProjectImageAction 
{
    public function __invoke(Request $request): ProjectImages
    {
        //$em=$this->getDoctrine()->getManager();
        $uploadedFile=$request->files->get('file');
//        $phase=$request->get('phase');
//        $desc=$request->get('description');
        if(!$uploadedFile){
            throw new BadRequestHttpException('"file" is required');
        }

        $projectImage=new ProjectImages();
        $projectImage->file=$uploadedFile;

//        $projectImage->setPhase($phase);
//        $projectImage->setDescription($desc);
//        $em->persist($projectImage);
//        $em->flush();

        return $projectImage;

    }

}
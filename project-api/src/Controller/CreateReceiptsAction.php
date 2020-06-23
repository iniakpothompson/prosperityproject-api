<?php


namespace App\Controller;
use App\Entity\ProjectPaymentReceiptFiles;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateReceiptsAction
{
    public function __invoke(Request $request): ProjectPaymentReceiptFiles
    {
        //$em=$this->getDoctrine()->getManager();
        $uploadedFile=$request->files->get('file');
//        $phase=$request->get('phase');
//        $desc=$request->get('description');
        if(!$uploadedFile){
            throw new BadRequestHttpException('"file" is required');
        }

        $receiptFiles=new ProjectPaymentReceiptFiles();
        $receiptFiles->file=$uploadedFile;

//        $projectImage->setPhase($phase);
//        $projectImage->setDescription($desc);
//        $em->persist($projectImage);
//        $em->flush();

        return $receiptFiles;

    }

}
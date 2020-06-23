<?php


namespace App\Controller;
use App\Entity\ProjectAgreementFile;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateProjectAgreementFileAction
{
    public function __invoke(Request $request): ProjectAgreementFile
    {
        //$em=$this->getDoctrine()->getManager();
        $uploadedFile = $request->files->get('file');
//        $phase=$request->get('phase');
//        $desc=$request->get('description');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $projectAgreementFile = new ProjectAgreementFile();
        $projectAgreementFile->file = $uploadedFile;

//        $projectImage->setPhase($phase);
//        $projectImage->setDescription($desc);
//        $em->persist($projectImage);
//        $em->flush();

        return $projectAgreementFile;
    }
}
<?php


namespace App\Controller;

use App\Entity\MinistryImage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateMinistryImageAction
{
    function __invoke(Request $request)
    {
        $uploadedFile=$request->files->get("file");
        if(!$uploadedFile){
            throw new BadRequestHttpException('"file" is required');
        }
        $ministryImage=new MinistryImage();
        $ministryImage->file=$uploadedFile;
        return $ministryImage;

    }
}
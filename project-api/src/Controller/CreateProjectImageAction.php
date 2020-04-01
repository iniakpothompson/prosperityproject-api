<?php

namespace App\Controller;

use App\Entity\ProjectImages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateProjectImageAction
{
    public function __invoke(Request $request): ProjectImages
    {
        $uploadedFile=$request->files->get('file');
        if(!$uploadedFile){
            throw new BadRequestHttpException('"file" is required');
        }

        $projectImage=new ProjectImages();
        $projectImage->file=$uploadedFile;
        return $projectImage;

    }

}
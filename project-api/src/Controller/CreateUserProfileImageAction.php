<?php


namespace App\Controller;

use App\Entity\UserProfileImages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
class CreateUserProfileImageAction
{
    function __invoke(Request $request)
    {
        $uploadedFile=$request->files->get("file");
        if(!$uploadedFile){
            throw new BadRequestHttpException('"file" is required');
        }
        $userprofileImage=new UserProfileImages();
        $userprofileImage->file=$uploadedFile;
        return $userprofileImage;

    }
}
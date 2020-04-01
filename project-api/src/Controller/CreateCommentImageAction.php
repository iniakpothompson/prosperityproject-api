<?php


namespace App\Controller;

use App\Entity\CommentImages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
class CreateCommentImageAction
{
        function __invoke(Request $request)
        {
            $uploadedFile=$request->files->get("file");
            if(!$uploadedFile){
                throw new BadRequestHttpException('"file" is required');
            }
            $commentImage=new CommentImages();
            $commentImage->file=$uploadedFile;
            return $commentImage;

        }
}
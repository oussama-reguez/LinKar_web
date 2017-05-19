<?php

namespace UploadBundle;
/**
 * Created by PhpStorm.
 * User: Rishya
 * Date: 01/04/2017
 * Time: 05:06
 */
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Liip\ImagineBundle\Controller;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);


        return $fileName;
    }
    public function getTargetDir()
    {
        return $this->targetDir;
    }

}
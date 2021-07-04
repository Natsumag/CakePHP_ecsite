<?php
namespace App\Model\Validation;
use Cake\Validation\Validation;

class CustomValidation extends Validation {

    public static function isFileType($files)
    {
        debug($files);
        exit();
        $ret = true;
        $file_type = pathinfo($files)['extension'];

        if (!($file_type === 'jpg') || !($file_type === 'jpeg') || !($file_type === 'png') || !($file_type === 'gif'))
        {
            $ret = false;
        }
        return $ret;
    }
}

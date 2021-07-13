<?php
namespace App\Model\Validation;
use Cake\Validation\Validation;

class CustomValidation extends Validation {

    public static function is_file_type($files)
    {
        $file_type = pathinfo($files)['extension'];
        if ($file_type === 'jpg' || $file_type === 'jpeg' || $file_type === 'png' || $file_type === 'gif')
        {
            return true;
        }
        return false;
    }
}

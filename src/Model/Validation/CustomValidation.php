<?php
namespace App\Model\Validation;
use Cake\Validation\Validation;

class CustomValidation extends Validation {
    /**
     * 緯度
     * @param string $value
     * @return bool
     */
    public static function isValidLatitude($value) {
        return (bool) preg_match('/^[0-9]+\.[0-9]+$/', $value);
    }

}

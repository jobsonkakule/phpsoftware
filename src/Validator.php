<?php
namespace App;

use finfo;
use Valitron\Validator as ValitronValidator;

class Validator extends ValitronValidator {

     protected static $_lang = "fr";

     public function __construct($data = array(), $fields = array(), $lang = null, $langDir = null)
     {
          parent::__construct($data, $fields, $lang, $langDir);
          self::addRule('image', function ($field, $value, array $params) {
               if ($value['size'] === 0) {
                    return true;
               }
               $mimes = ['image/jpeg', 'image/png'];
               $finfo = new finfo();
               $info = $finfo->file($value['tmp_name'], FILEINFO_MIME_TYPE);
               return in_array($info, $mimes);
          }, "n'est pas une image valide");
     }
    
    /**
    * @param  string $field
    * @param  string $message
    * @param  array  $params
    * @return array
    */
   protected function checkAndSetLabel($field, $message, $params)
   {
        return $message = str_replace('{field}', 'Ce champs', $message);
   }
}
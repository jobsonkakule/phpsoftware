<?php
namespace App\Validators;

use App\Validator;
use App\Table\DiseaseTable;

class DiseaseValidator extends AbstractValidator {

    public function __construct(array $data, DiseaseTable $table, ?int $userId = null, array $states, array $flags)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name']);
        $this->validator->rule('lengthBetween', ['name'], 3, 100);
        $this->validator->rule('lengthBetween', ['description'], 10, 200);
        $this->validator->rule('image', 'image');
        $this->validator->rule('subset', 'state', $states);
        $this->validator->rule('subset', 'flag', $flags);
        // $this->validator->rule(function ($field, $value) use ($states) {
        //     return in_array($value, $states);
        // }, ['state'], 'n\'est pas valide');
        // $this->validator->rule(function ($field, $value) use ($flags) {
        //     return in_array($value, $flags);
        // }, ['flag'], 'n\'est pas valide');
        $this->validator->rule(function ($field, $value) use ($table, $userId) {
            return !$table->exists($field, $value, $userId);
        }, ['name'], 'existe déjà dans la base de données');
    }
}
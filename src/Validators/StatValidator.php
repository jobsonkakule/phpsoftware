<?php
namespace App\Validators;

use App\Validator;
use App\Table\StatTable;

class StatValidator extends AbstractValidator {

    public function __construct(array $data, array $cities, array $diseases)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['cases', 'deaths', 'recoveries']);
        $this->validator->rule('integer', ['cases', 'deaths', 'recoveries'], true);
        $this->validator->rule('subset', 'city_id', array_keys($cities));
        $this->validator->rule('subset', 'disease_id', array_keys($diseases));
        $this->validator->rule(function ($field, $value) {
            return $value > 0;
        }, ['cases', 'deaths', 'recoveries'], 'doit être supérieur à 0');
    }
}
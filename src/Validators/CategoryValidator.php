<?php
namespace App\Validators;

use App\Validator;
use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator {

    public function __construct(array $data, CategoryTable $table, ?int $id = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name']);
        $this->validator->rule('lengthBetween', ['name'], 3, 100);
        $this->validator->rule(function ($field, $value) use ($table, $id) {
            return !$table->exists($field, $value, $id);
        }, ['name'], 'existe déjà dans la base de données');
    }
}
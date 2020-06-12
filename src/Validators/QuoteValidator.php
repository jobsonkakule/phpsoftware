<?php
namespace App\Validators;

use App\Validator;
use App\Table\QuoteTable;

class QuoteValidator extends AbstractValidator {

    public function __construct(array $data, QuoteTable $table, ?int $quoteId = null)
    {
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'content']);
        $this->validator->rule('lengthBetween', ['name'], 5, 100);
        $this->validator->rule('lengthBetween', ['content'], 10, 300);
        $this->validator->rule('image', 'image');
        $this->validator->rule(function ($field, $value) use ($table, $quoteId) {
            return !$table->exists($field, $value, $quoteId);
        }, ['title'], 'existe déjà dans la base de données');
    }
}
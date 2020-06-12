<?php
namespace App\Validators;

use App\Validator;
use App\Table\UserTable;

class UserValidator extends AbstractValidator {

    public function __construct(array $data, UserTable $table, ?int $userId = null, ?array $roles = [])
    {
        parent::__construct($data);
        if ($data['role']) {
            $this->validator->rule('subset', 'role', array_keys($roles));
        } else {
            $pass = $data['password'];
            $this->validator->rule('required', ['username','password', 'confirm']);
            $this->validator->rule('lengthBetween', ['username','password', 'confirm'], 4, 20);
            $this->validator->rule(function ($field, $value) use ($pass) {
                return $value === $pass;
            }, ['confirm'], 'ne correspond pas au premier mot de passe');
            $this->validator->rule(function ($field, $value) use ($table, $userId) {
                return !$table->exists($field, $value, $userId);
            }, ['username'], 'existe déjà dans la base de données');
        }
    }
}
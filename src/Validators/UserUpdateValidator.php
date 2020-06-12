<?php
namespace App\Validators;

use App\Validator;
use App\Table\UserTable;

class UserUpdateValidator extends AbstractValidator {

    public function __construct(array $data, UserTable $table, ?int $userId = null)
    {
        parent::__construct($data);
        $pass = $data['password'];
        // $value = $data['confirm'];
        // dd($value === $pass, $value, $pass);
        $this->validator->rule('required', ['username']);
        $this->validator->rule('lengthBetween', ['username','password', 'email', 'confirm'], 4, 50);
        $this->validator->rule('lengthBetween', ['description'], 10, 200);
        $this->validator->rule('image', 'image');
        $this->validator->rule(function ($field, $value) use ($pass) {
            return $value === $pass;
        }, ['confirm'], 'ne correspond pas au premier mot de passe');
        $this->validator->rule(function ($field, $value) use ($table, $userId) {
            return !$table->exists($field, $value, $userId);
        }, ['username'], 'existe déjà dans la base de données');
    }
}
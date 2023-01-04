<?php
/*
 * Copyright (c) 2022.
 * User: Fesdam
 * project: WizarFrameWork
 * Date Created: $file.created
 * 7/3/22, 3:50 AM
 * Last Modified at: 7/3/22, 3:50 AM
 * Time: 3:50
 * @author Wizarphics <Wizarphics@gmail.com>
 *
 */

namespace app\models;

use wizarphics\wizarframework\UserModel;

class User extends UserModel
{

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public string $remberMe = '';
    public string $consent = '';



    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, 'alpha'],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_UNIQUE . ':' . $this->tableName() . '.email'],
            'password' => [self::RULE_REQUIRED, self::RULE_MIN . ':8', self::RULE_MAX . ':24'],
            'passwordConfirm' => [self::RULE_REQUIRED, self::RULE_MATCH . ':password'],
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password',
            'status',
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'passwordConfirm' => 'Confirm Password',
            'consent' => 'I\'ve read and agree to the <a href="https://" class="text-danger">Terms</a> and <a href="https://" class="text-danger">Conditions</a>',
            'remberMe' => 'Stay signed in.'
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}

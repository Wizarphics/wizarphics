<?php

namespace app\models;

use wizarphics\wizarframework\Model;

class ContactModel extends Model{
    

    public string $name='';

    public string $subject='';
    public string $email='';
    public string $phone='';
    public string $message = '';
    public string $address='';
    public string $companyEmail = '';
    public string $companyName = '';
    public string $companyPhone = '';
    public string $companyAddress = '';

    public string $body='';

	/**
	 * @return array
	 */
	public function rules(): array {
        return [
            'name' => [self::RULE_REQUIRED],
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>15]]
        ];
	}

    public function labels():array
    {
        return [
            'name'=>'Name',
            'subject'=>'Subject',
            'email'=>'Email Address',
            'body'=>'Body',
            'companyEmail'=>'Company\'s Email',
        ];
    }

    public function send()
    {        
        return true;
    }
}
<?php

namespace app\models\forms;

use app\models\user\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $user_name;
    public $user_email;
    public $user_designation;
    public $user_institution_name;
    public $user_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_name', 'filter', 'filter' => 'trim'],
            ['user_name', 'required'],
            ['user_name', 'unique', 'targetClass' => '\app\models\user\User', 'message' => 'This username has already been taken.'],
            ['user_name', 'string', 'min' => 2, 'max' => 45],
            ['user_email', 'filter', 'filter' => 'trim'],
            ['user_email', 'required'],
            ['user_email', 'email'],
            ['user_email', 'unique', 'targetClass' => '\app\models\user\User', 'message' => 'This email address has already been taken.'],
            ['user_password', 'required'],
            ['user_password', 'string', 'min' => 6],
            ['user_designation', 'string', 'max' => 45],            
            ['user_designation', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_name' => 'User name',
            'user_email' => 'Email',
            'user_designation' => 'Designation',
            'user_institution_name' => 'Institution name',
            'user_password' => 'Password',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate())
        {
            $user = new User();
            $user->user_name = $this->user_name;
            $user->user_designation = $this->user_designation;
            $user->user_institution_name = $this->user_institution_name;
            $user->user_email = $this->user_email;
            $user->setPassword($this->user_password);
            $user->generateAuthKey();
            if ($user->save())
            {
                return $user;
            }
        }

        return null;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: VK
 * Date: 09.12.2018
 * Time: 12:05
 */

namespace app\models;


use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [[['username','password'],'required','message'=>'error'],]; // TODO: Change the autogenerated stub
    }

    public function attributeLabels()
    {
        return [
            [['username', 'password'], 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
        ];
    }
}
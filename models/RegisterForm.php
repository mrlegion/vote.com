<?php


namespace app\models;


use yii\base\Model;

/**
 * Class RegisterForm
 * @package app\models
 *
 * @property string $email
 * @property string $phone
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $home
 * @property string $age
 * @property string $description
 * @property integer $rating
 */
class RegisterForm extends Model
{
    public $email;
    public $phone;
    public $region;
    public $city;
    public $street;
    public $home;

    public $age;
    public $description;
    public $rating;

    public function rules()
    {
        return [
            [['email', 'phone', 'region', 'city', 'street', 'home'], 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['region', 'city', 'street', 'home'], 'string', 'max' => 255]
        ];
    }


}


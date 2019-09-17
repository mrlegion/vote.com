<?php


namespace app\models;


use yii\base\Model;

class FoundForm extends Model
{
    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $home;

    public function rules()
    {
        return [
            [['region', 'city', 'street', 'home'], 'required'],
            ['region', 'string', 'max' => '150'],
            [['city', 'street'], 'string', 'max' => '100'],
            ['home', 'string', 'max' => '20'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'region' => 'Регион',
            'city' => 'Населенный пункт',
            'street' => 'Улица',
            'home' => 'Дом',
        ];
    }

}
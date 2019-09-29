<?php


namespace app\models;


use Yii;
use yii\base\Model;

/**
 * Class RegisterForm
 * @package app\models
 *
 * @property string $email
 * @property string $phone
 * @property string $state
 * @property string $city
 * @property string $street
 * @property string $home
 * @property string $age
 * @property string $text
 * @property integer $ratio
 * @property boolean $accept
 */
class RegisterForm extends Model
{
    public $email;
    public $phone;
    public $state;
    public $city;
    public $street;
    public $home;

    public $age;
    public $text;
    public $ratio;

    public $accept;

    public function rules()
    {
        return [
            [['email', 'phone', 'state', 'city', 'street', 'home', 'accept'], 'required'],
            ['accept', 'boolean'],
            ['accept', 'checkAcceptTeam'],
            ['phone', 'string', 'max' => 20],
            ['email', 'string', 'max' => 255],
            ['email', 'email'],
            [['email', 'phone', 'state', 'city', 'street', 'home'], 'trim'],
            ['age', 'string', 'max' => 50],
            [['state', 'city', 'street'], 'string', 'max' => 100],
            ['home', 'string', 'max' => 20],
            ['ratio', 'integer'],
            ['text', 'string'],
            ['text', 'safe'],
        ];
    }

    public function checkAcceptTeam($attribute, $params)
    {
        if (!$this->accept) {
            $this->addError($attribute, Yii::t('app','It is necessary to accept consent to the processing of personal data'));
        }
    }

    public function attributeLabels()
    {
        return [
            'email'     => Yii::t('app','Email'),
            'phone'     => Yii::t('app','Phone'),
            'state'     => Yii::t('app','State'),
            'city'      => Yii::t('app','City'),
            'street'    => Yii::t('app','Street'),
            'home'      => Yii::t('app','Home'),
            'accept'    => Yii::t('app','Accept'),
            'age'       => Yii::t('app','Age'),
            'ratio'     => Yii::t('app','Rating'),
        ];
    }



    /**
     * Get array params for User model
     * @return array
     * @throws \yii\base\Exception
     */
    public function getUserArray() : array
    {
        return [
            'User' => [
                'email'     => $this->email,
                'phone'     => $this->phone,
                'state'     => $this->state,
                'city'      => $this->city,
                'street'    => $this->street,
                'home'      => $this->home,
                'age'       => $this->age,
                'email_confirm_token' => Yii::$app->security->generateRandomString(),
                'status'    => User::STATUS_WAIT,
            ],
        ];
    }

    /**
     * Get array params for Vote model
     * @return array
     */
    public function getVoteArray() : array
    {
        return [
            'Vote' => [
                'text'  => $this->text,
                'ratio' => $this->ratio,
            ],
        ];
    }
}


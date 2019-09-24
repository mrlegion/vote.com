<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $phone
 * @property string $email
 * @property string $age
 * @property string $state
 * @property string $city
 * @property string $street
 * @property string $home
 * @property string $email_confirm_token
 * @property integer $status
 *
 * @property Vote[] $votes
 */
class User extends \yii\db\ActiveRecord
{
    const AGES = [
        '1' => 'Less 18',
        '2' => '18-24',
        '3' => '25-29',
        '4' => '30-39',
        '5' => '40-49',
        '6' => '50-59',
        '7' => '60+',
    ];

    const STATUS_ACTIVE = 6;
    const STATUS_WAIT = 5;
    const STATUS_UNACTIVE = 0;
    const STATUS_DELETED = 9;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'email', 'age', 'state', 'city', 'street', 'home'], 'required'],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
            [['age'], 'string', 'max' => 50],
            [['state', 'city', 'street'], 'string', 'max' => 100],
            [['home'], 'string', 'max' => 20],
            ['email_confirm_token', 'string', 'max' => 255],
            ['status', 'in', 'range' => [self::STATUS_UNACTIVE, self::STATUS_ACTIVE, self::STATUS_WAIT, self::STATUS_DELETED]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'age' => Yii::t('app', 'Age'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'home' => Yii::t('app', 'Home'),
            'status' => Yii::t('app','Status'),
            'email_confirm_token' => Yii::t('app','Email confirmed token'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['user_id' => 'id']);
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function sendConfirmEmail()
    {
        $send = Yii::$app->mailer
            ->compose(['html' => 'verify'],['user' => $this])
            ->setTo($this->email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('Подтверждение регистрации')
            ->send();
        if (!$send)
            throw new \RuntimeException('Send mail error');
    }
}

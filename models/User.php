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
 *
 * @property Vote[] $votes
 */
class User extends \yii\db\ActiveRecord
{
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
            [['phone'], 'string', 'max' => 13],
            [['email'], 'string', 'max' => 255],
            [['age'], 'string', 'max' => 50],
            [['state', 'city', 'street'], 'string', 'max' => 100],
            [['home'], 'string', 'max' => 20],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['user_id' => 'id']);
    }
}

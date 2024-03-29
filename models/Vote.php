<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vote".
 *
 * @property int $id
 * @property int $user_id
 * @property int $ratio
 * @property string $text
 *
 * @property User $user
 */
class Vote extends ActiveRecord
{

    const RATING_VALUES = [
        '1'  => '1',
        '2'  => '2',
        '3'  => '3',
        '4'  => '4',
        '5'  => '5',
        '6'  => '6',
        '7'  => '7',
        '8'  => '8',
        '9'  => '9',
        '10' => '10',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'ratio'], 'required'],
            [['user_id', 'ratio'], 'integer'],
            [['text'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'ratio' => Yii::t('app', 'Rating'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

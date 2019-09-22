<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $access_token
 * @property string $verify_token
 * @property string $email
 * @property int $is_blocked
 * @property string $created_at
 * @property string $updated_at
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'access_token', 'verify_token', 'created_at', 'updated_at'], 'required'],
            [['is_blocked'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password_hash', 'access_token', 'verify_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'access_token' => Yii::t('app', 'Access Token'),
            'verify_token' => Yii::t('app', 'Verify Token'),
            'email' => Yii::t('app', 'Email'),
            'is_blocked' => Yii::t('app', 'Is Blocked'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}

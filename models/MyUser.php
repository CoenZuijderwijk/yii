<?php

namespace app\models;

use app\components\UppercaseBehaviour;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 */
class MyUser extends \yii\db\ActiveRecord
{
    public function fields() {
        return [
            'id',
            'name',
        ];
    }

    public function extraFields() {
        return ['email'];
    }
    const EVENT_NEW_USER = 'new-user';
    public function behaviors()
    {
        return [
    UppercaseBehaviour::className(),
    ];
    }

    public function init() {
        // first parameter is the name of the event and second is the handler.
        $this->on(self::EVENT_NEW_USER, [$this, 'sendMailToAdmin']);
    }
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
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
        ];
    }

    public function sendMailToAdmin($event) {
        echo 'mail sent to admin using the event';
    }
}

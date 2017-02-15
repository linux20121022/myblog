<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_contact_form".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $ip
 * @property integer $create_time
 */
class ContactForm extends \yii\db\ActiveRecord
{
    public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_contact_form';
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->subject = '留言内容';
                $this->create_time = time();
                $this->ip = Yii::$app->getRequest()->getUserIP();
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required'],
            [['body'], 'string'],
            [['create_time'], 'integer'],
            [['name', 'email'], 'string', 'max' => 30],
            [['subject'], 'string', 'max' => 128],
            [['ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'ip' => 'Ip',
            'create_time' => 'Create Time',
            'verifyCode' => 'Verification Code',
        ];
    }
/**
 * Sends an email to the specified email address using the information collected by this model.
 *
 * @param string $email the target email address
 * @return bool whether the email was sent
 */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom([$email => $this->name])
            ->setSubject('留言成功')
            ->setTextBody("留言成功")
            ->send();
    }
}

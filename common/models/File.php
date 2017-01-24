<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_file".
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $status
 * @property varchar $url
 * @property integer $create_time
 * @property integer $update_time
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id','url'], 'required'],
            [['content_id', 'status', 'create_time', 'update_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'Content ID',
            'status' => 'Status',
            'url' => 'url',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}

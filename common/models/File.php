<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_file".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $status
 * @property integer $img_size
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
            [['article_id'], 'required'],
            [['article_id', 'status', 'create_time', 'update_time', 'img_size'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'status' => 'Status',
            'img_size' => 'Img Size',
            'img_src' => 'Img Src',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}

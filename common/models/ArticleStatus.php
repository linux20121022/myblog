<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_article_status".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class ArticleStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_article_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'type', 'position'], 'required'],
            [['code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 128],
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
            'code' => 'Code',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }

    /**
     * @return mixed 返回下拉列表数据
     */
    public static function getStatus(){
        $arr = static::find()->all();
        foreach($arr as $key=>$val){
            $status_arr[$val['id']] = $val['name'];
        }
        return $status_arr;
    }
}

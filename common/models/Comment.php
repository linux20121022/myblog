<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "blog_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * @property BlogArticle $post
 */
class Comment extends \yii\db\ActiveRecord
{
    public  function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->ip = Yii::$app->request->getUserIP();
                $this->url = Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
                $this->create_time = time();
                return true;
            }else{
                return false;
            }
        }
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'post_id'], 'integer'],
            [['author', 'email', 'url'], 'string', 'max' => 128],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'author' => 'Author',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Article::className(), ['id' => 'post_id']);
    }

    /**
     * @desc 增加评论
     * @param $params
     * @throws BadRequestHttpException
     */
    public function addComment($params)
    {
        $this->content = $params['Comment']['content'];
        $this->status = 2;
        $this->post_id = $params['Comment']['post_id'];
        try {
            if ($this->save(false)) {
                return true;
            } else {
                return false;
            }
        }catch(InvalidParamException $e){
            throw new BadRequestHttpException($e->getMessage());
        }
    }
    public function findComm($id)
    {
        $id =trim($id);
        $data = $this::find()->where("post_id=:post_id",[":post_id"=>$id])->all();
        return $data;
    }
}

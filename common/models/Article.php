<?php

namespace common\models;

use Yii;
use common\models\ArticleExtend;
use yii\helpers\Html;

/**
 * This is the model class for table "blog_article".
 *
 * @property integer $id
 * @property string $title
 * @property integer $content_id
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property BlogUser $author
 * @property BlogComment[] $blogComments
 */
class Article extends \yii\db\ActiveRecord
{
    public $content;
    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->create_time = time();
                $this->update_time = time();
                $this->author_id = Yii::$app->user->identity->id;
            }else{
                $this->author_id = Yii::$app->user->identity->id;
                $this->update_time = time();
            }
            return true;
        }else{
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content_id', 'status', 'author_id'], 'required'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['tags'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content_id' => '内容id',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'author_id' => '作者id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleExtends()
    {
        return self::hasOne(ArticleExtend::className(),['id'=>'content_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @desc 增加,保存文章
     */
    public function addArticle($post){
        //开启事物
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model_extend = new ArticleExtend();
            if($post['Article']['content_id']) {
                $update_model_extend = $model_extend->findOne($post['Article']['content_id']);
                $update_model_extend->content = Html::encode($post['Article']['content']);
                $update_model_extend->save();
                $model_extend_id = $post['Article']['content_id'];
            }else{
                $model_extend->findOne($post['Article']['content_id']);
                $model_extend->content = Html::encode($post['Article']['content']);
                $model_extend->save();
                $model_extend_id = $model_extend->primaryKey;
            }
            $this->title = Html::encode($post['Article']['title']);
            $this->tags = Html::encode($post['Article']['tags']);
            $this->content_id = $model_extend_id;
            $this->status = Html::encode($post['Article']['status']);
            $this->save(false);
            if ($transaction->commit()) {
                return true;
            } else {
                return false;
            }
        }catch(Exception $e) {
            $transaction->rollBack();
        }
    }
}

<?php

namespace common\models;

use Yii;
use common\models\ArticleExtend;
use yii\helpers\Html;
use common\models\File;
use yii\base\Exception;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blog_article".
 *
 * @property integer $id
 * @property string $title
 * @property integer $content_id
 * @property string $tags
 * @property integer $status
 * @property integer $file_id
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property BlogUser $author
 * @property BlogComment[] $blogComments
 * @property File $file
 */
class Article extends \yii\db\ActiveRecord
{
    public $content;
    public $img_src;
    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->create_time = time();
                $this->update_time = time();
                $this->author_id = Yii::$app->user->identity->id;
                $file_model = new File();
                $file_model->create_time = time();
                $file_model->update_time = time();
            }else{
                $this->author_id = Yii::$app->user->identity->id;
                $this->update_time = time();
                $file_model = new File();
                $file_model->update_time = time();
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
            [['status', 'create_time', 'update_time', 'author_id','file_id'], 'integer'],
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
//            'img_src' => '图片',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'file_id' => '文件id',
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
    public function getFile(){
        return $this->hasOne(File::className(),['id' => 'file_id']);
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
            if(isset($post['Article']['content_id'])) {
                //更新内容表
                $update_model_extend = $model_extend->findOne($post['Article']['content_id']);
                $update_model_extend->content = Html::encode($post['Article']['content']);
                $update_model_extend->save();
                $model_extend_id = $post['Article']['content_id'];
            }else{
                //插入内容表
                $model_extend->content = Html::encode($post['Article']['content']);
                $model_extend->save();
                $model_extend_id = $model_extend->primaryKey;
            }
            $file = new File();
            if(isset($post['Article']['content_id']) && $post['Article']['file_id'] > 0 && !empty($_FILES['File']['name']['img_src'])){
                //更新图片
                $update_file = $file->findOne($post['Article']['file_id']);
                $update_file->img_src = UploadedFile::getInstance($update_file,'img_src');
                $update_file->article_id = $post['Article']['id'];
                $update_file->img_size = $update_file->img_src->size;
                if(!is_dir('uploads/'.date("Y").'/'.date("m").'/'.date("d"))){
                    mkdir('uploads/'.date("Y").'/'.date("m").'/'.date("d"),'777',true);
                }
                $dir_name = 'uploads/'.date("Y").'/'.date("m").'/'.date("d").'/';
                if ($update_file->img_src && $update_file->validate()) {
                    $update_file->img_src->saveAs($dir_name . $update_file->img_src->baseName . '.' . $update_file->img_src->extension);
                    $update_file->img_src = $dir_name . $update_file->img_src->baseName . '.' . $update_file->img_src->extension;
                }
                $update_file->save();
                $file_id = $post['Article']['file_id'];
            }elseif(!empty($_FILES['File']['name']['img_src'])){
                //插入图片
                //上传图片
                $file->img_src = UploadedFile::getInstance($file,'img_src');
                $file->article_id = $post['Article']['id'];
                $file->img_size = $file->img_src->size;
                if(!is_dir('uploads/'.date("Y").'/'.date("m").'/'.date("d"))){
                    mkdir('uploads/'.date("Y").'/'.date("m").'/'.date("d"),'777',true);
                }
                $dir_name = 'uploads/'.date("Y").'/'.date("m").'/'.date("d").'/';
                if ($file->img_src && $file->validate()) {
                    $file->img_src->saveAs($dir_name . $file->img_src->baseName . '.' . $file->img_src->extension);
                    $file->img_src = $dir_name . $file->img_src->baseName . '.' . $file->img_src->extension;
                }
                $file->save();
                $file_id = $file->primaryKey;
            }
            $this->title = Html::encode($post['Article']['title']);
            $this->tags = Html::encode($post['Article']['tags']);
            $this->content_id = $model_extend_id;
            if(isset($file_id) && $file_id > 0){
                $this->file_id = $file_id;
            }
            $this->status = Html::encode($post['Article']['status']);

            $this->save(false);
            $transaction->commit();
                return true;
        }catch(Exception $e) {
            $transaction->rollBack();
        }
    }

    /**
     * @desc 首页的文章图文列表
     */
    public static function indexPicList($p = 0){
        $data = Article::find()->joinwith("file")->joinWith("articleExtends")->select("title,tags,img_src,content,blog_article.id")->where(['>', 'file_id', 0])->andWhere(['=', 'blog_article.status', 2])->orderBy('blog_article.id desc')->offset($p*6)->limit(6)->all();
//        echo Article::find()->joinwith("file")->joinWith("articleExtends")->select("title,tags,img_src,content,blog_article.id")->where(['>', 'file_id', 0])->andWhere(['=', 'blog_article.status', 2])->orderBy('blog_article.id desc')->offset($p*6)->limit(6)->createCommand()->getRawSql();
//        var_dump($data);
        return $data;
    }

    /**
     * @desc 纯文章列表
     * @param int $p
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function indexList($p = 0){
        $data = Article::find()->joinwith("file")->joinWith("articleExtends")->select("title,tags,img_src,content,blog_article.id")->where(['=', 'file_id', 0])->andWhere(['=', 'blog_article.status', 2])->orderBy('blog_article.id desc')->offset($p*8)->limit(8)->all();
//        echo  Article::find()->joinwith("file")->joinWith("articleExtends")->select("title,tags,img_src,content,blog_article.id")->where(['=', 'file_id', 0])->andWhere(['=', 'blog_article.status', 2])->orderBy('blog_article.id desc')->offset($p*8)->limit(8)->createCommand()->getRawSql();
        return $data;
    }
    public static function view(){
        $data = Article::find()->joinwith("file")->joinWith("articleExtends")->select("title,tags,img_src,content,blog_article.id")->where(['>', 'file_id', 0])->andWhere(['=', 'blog_article.status', 2])->orderBy('blog_article.id desc')->find();
//        var_dump($data);
        return $data;
    }
}

<?php

namespace backend\controllers;

use common\helps\ConFun;
use common\models\File;
use Yii;
use common\models\Article;
use common\models\SearchArticle;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kucha\ueditor\UEditor;
use common\models\ArticleStatus;
use yii\helpers\StringHelper;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public $layout = "iframe_main";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchArticle();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //查询文章的状态
//        $article = new ArticleStatus();
//        $status_arr = $article->getStatus();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'status_arr'=> $status_arr,
        ]);
    }
    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $article_extends = $model->articleExtends;
        $model->content = html::decode($article_extends->content);
        //查询文章的状态
        $article = new ArticleStatus();
        $status_arr = $article->getStatus();
        $img_src = $model->file->img_src;
        return $this->render('view', [
            'model' => $model,
            'status_arr'=>$status_arr,
            'src' => $img_src
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $flag = $model->addArticle($post);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //查询文章的状态
            $article = new ArticleStatus();
            $status_arr = $article->getStatus();
            return $this->render('create', [
                'model' => $model,'status_arr'=>$status_arr
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $article_model = new Article();
        $model = $this->findModel($id);
        $file_model = new File();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->addArticle($post);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //查询文章的状态
            $article = new ArticleStatus();
            $status_arr = $article->getStatus();
            $article_extends = $model->articleExtends;
            $model->content = $article_extends ? html::decode($article_extends->content) : '';
            $model->create_time = date("Y-m-d H:i:s",$model->create_time);
            $img_src = isset($model->file->img_src) ? $model->file->img_src : '/default/1.img';
            return $this->render('update', [
                'model' => $model,
                'file_model' => $file_model,
                'status_arr'=>$status_arr,
                'img_src' => $img_src
            ]);
    }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

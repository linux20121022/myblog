<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ArticleStatus;
use yii\helpers\StringHelper;
//use common\helps\ConFun;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchArticle */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('新建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header'=>'排序','headerOptions' => ['width' => '50']],
            'id',
            'title',
            'tags:ntext',
            [
                'attribute' => 'status',
                'value' => function ($searchModel){
                    return ArticleStatus::getStatus()[$searchModel->status];
                }
            ],
            [
//                'attribute' => 'content',
                'label'=>'内容',
                'format' => 'html',
                'value' => function($model){
//                   $model->articleExtends->content;
                   return StringHelper::truncate_utf8_string(html::decode($model->articleExtends->content),20);
                }
//                'value' => 'hello world'
            ],//不产生带搜索框的列表
//            'create_time:datetime',
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            ['class' => 'yii\grid\ActionColumn','header' => '操作','headerOptions' => ['width' => '70']],
        ],
    ]); ?>
</div>

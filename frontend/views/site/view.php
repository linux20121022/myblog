<?php

use yii\helpers\StringHelper;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kucha\ueditor\UEditor;

/* @var $this yii\web\View */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- Header -->
<header id="header">
    <a href="#" class="image avatar"><img src="images/avatar.jpg" alt="" /></a>
    <h1>
        <strong><?= $user->username ?></strong>
        <p> PHP开发者</p>
        <p><?= $user->email ?></p>
    </h1>
</header>

<!-- Main -->
<div id="main">
<!-- One -->
<section id="one">
    <header class="major">
        <h2>介绍</h2>
    </header>
    <p>该博客是为了记录平时遇到的问题和积累相关项目经验</p>
</section>
    <h2><a href="<?= Yii::$app->homeUrl ?>">首页</a>  <a href="javascript:void(0);"> > <?= Html::encode($this->title) ?></a> </h2>
    <div class="article-view">

        <h1 style="text-align: center"><?= Html::decode($this->title) ?></h1>
        <div style="text-align: center">
            <span>作者:</span><span><?= $model->author->username;?></span>&nbsp;
            <span>时间:</span><span><?= date("Y-m-d H:i:s",$model->create_time);?></span>
        </div>
        <p>
            <?= Html::decode($model->content) ?>
        </p>
        <div class="h-article-share">
            <span class="h-fx-article fl">分享到：</span>
            <a href="javascript:void(0)" class="h-icon-s2 h-article-xlwb"></a>
<!--            <a href="javascript:void(0)" class="h-icon-s2 h-article-db"></a>-->
            <a href="javascript:void(0)" class="h-icon-s2 h-article-txwb"></a>
            <a href="javascript:void(0)" class="h-icon-s2 h-article-kj"></a>
<!--            <a href="javascript:void(0)" class="h-icon-s2 h-article-wx"></a>-->
            <a class="article-b-zan fun-zan" href="javascript:void(0)" data-id="<?php echo $model->id;?>"><span>0</span></a>
            <a class="article-b-care fun-sc" href="javascript:void(0)"><span></span></a>

        </div>
        <h2>留言</h2>
        <?php $form = ActiveForm::begin(['action'=>'/index.php?r=site/addcomment','options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($comment,'content')->widget('kucha\ueditor\UEditor',[])->label("内容");?>
        <?= $form->field($comment,'post_id')->hiddenInput(['value' => $model->id])->label(false) ?>
            <?= Html::submitButton($comment->isNewRecord ? '添加' : '更新', ['class' => $comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div id="comment-list">
        <ul id="w1" class="media-list">
            <?php foreach($comm_data as $key=>$val){?>
            <li class="media" data-key="1278" style="list-style-type:none;">
                <div class="media-body">
                    <div class="media-heading">
                        <a href="/user/31641" rel="author"><?php echo $val->ip;?></a> 评论于 <?php echo date("Y-m-d H:i",$val->create_time);?>
                    </div>
                    <div class="media-content">
                        <p><?php echo $val->content;?></p>
                    </div>
                    <div class="media-action">
                        <a class="reply" href="javascript:void(0);"><i class="fa fa-reply"></i> 回复</a>
                        <span class="pull-right">
                            <a class="vote up" href="javascript:void(0);" title="" data-type="comment" data-id="1278" data-toggle="tooltip" data-original-title="顶"><i class="fa fa-thumbs-o-up"></i> 0</a>
                            <a class="vote down" href="javascript:void(0);" title="" data-type="comment" data-id="1278" data-toggle="tooltip" data-original-title="踩"><i class="fa fa-thumbs-o-down"></i> 0</a>
                        </span>
                    </div>
                </div>
            </li>
            <?php }?>
        </ul>
    </div>
</div>

<?php $this->registerJsFile('@web/js/jquery.min.js');?>
<?php $this->registerJsFile('@web/js/jquery.poptrox.min.js');?>
<?php $this->registerJsFile('@web/js/jquery.qrcode.min.js');?>
<?php $this->registerJsFile('@web/js/skel.min.js');?>
<?php $this->registerJsFile('@web/js/init.js');?>
<?php $this->registerJsFile('@web/js/common.js');?>









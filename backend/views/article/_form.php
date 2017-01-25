<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kucha\ueditor\UEditor;


/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($file_model,'img_src')->fileInput()->label("图片");?>
    <?= Html::img($img_src,['alt' => 'My logo','witdh' => 100,'height' => 100]) ?>
    <?= $form->field($model,'content')->widget('kucha\ueditor\UEditor',[])->label("内容");?>
    <?= $form->field($model, 'tags')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'status')->dropDownList($status_arr) ?>
    <?= $form->field($model, 'content_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'file_id')->hiddenInput(['value' => $file_model->id])->label(false) ?>
<!--     $form->field($model, 'create_time')->textInput() -->

<!--     $form->field($model, 'update_time')->textInput() -->

<!--     $form->field($model, 'author_id')->textInput() -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

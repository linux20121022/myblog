
<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//AppAsset::addCss($this,'@web/css/b_login.js');
$this->registerCssFile('@web/css/rightmain.css');
?>
<div class="row" style="width: 300px;margin-right: 0px;margin-left: 0px; ">

<!--//    Html::beginForm(['/site/introduce'], 'post').-->
<!--//    Html::input('text','username',Yii::$app->user->identity->username,['class' => 'form-control','placeholder'=>Yii::$app->user->identity->username]).-->
<!--//    Html::input('email','email',Yii::$app->user->identity->email,['class' => 'form-control']).-->
<!--//    Html::submitButton('修改',['class' => 'btn']).-->
<!--//    Html::endForm();-->

    <?php $form = ActiveForm::begin(['action'=>['/site/introduce'],'method'=>'post']);?>
    <?= $form->field($model,'username')->textInput(['maxlength' => 20,'value'=>Yii::$app->user->identity->username])?>

    <?= $form->field($model, 'id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>
    <?= $form->field($model,'email')->textInput(['maxlength' => 80,'value'=>Yii::$app->user->identity->email])?>
    <?= Html::submitButton('提交', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
    <?php ActiveForm::end();?>
</div>
<!-- 第一行结束 -->
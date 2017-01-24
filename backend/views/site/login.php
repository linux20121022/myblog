<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//AppAsset::addCss($this,'@web/css/b_login.js');
$this->registerCssFile('@web/css/b_login.css');
?>
<div class="login">
    <div class="loginmain">
        <h2>登录管理系统</h2>
        <?php $form = ActiveForm::begin(['action'=>[''],'method'=>'post','class'=>'form-horizontal'])?>
        <?php echo $form->field($model,'username')->textInput(['style' => 'width:350px']);?>
        <?php echo $form->field($model,'password')->passwordInput(['style' => 'width:350px'])?>
        <div class="form-group">
            <div class="col-lg-11 col-lg-offset-1">
		                <span class="checkbox ">
		                    <label>
                                <input type="checkbox" name="rememberMe" class="checkbox-inline" value="1">记住我
                            </label>
		                </span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-4 col-lg-offset-1">
                <?php echo Html::submitButton('登录', ['class'=>'btn btn-danger btn-lg','name' =>'button'])?>
                <span class="text"></span>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="rightpic">
        <div id="container">
        </div>
    </div>
</div>
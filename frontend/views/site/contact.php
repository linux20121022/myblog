<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin(['action' => [''],'method'=>'post','id' => "contact_form", 'options' => ['onsubmit' => 'return false;']]);
?>
<!--    <form method="post" action="javascript:void(0);" id="contact_form">-->
<div class="row uniform 50%">
    <div class="6u 12u$(3)">
        <?=  $form->field($contactForm, 'name')->textInput(['placeholder' => '姓名'])->label(false) ?>
        <!--                <input type="text" name="ContactForm[name]" id="demo-name" value="" placeholder="姓名" />-->
    </div>
    <div class="6u$ 12u$(3)">
        <?=  $form->field($contactForm, 'email')->textInput(['placeholder' => '邮箱'])->label(false) ?>
        <!--                <input type="email" name="ContactForm[email]" id="demo-email" value="" placeholder="邮箱" />-->
    </div>
    <div class="12u$">
        <?=  $form->field($contactForm, 'body')->textarea(['rows'=>3,'placeholder' => '留言内容……'])->label(false) ?>
        <!--                <textarea name="ContactForm[body]" id="demo-message" placeholder="留言内容……" rows="6"></textarea>-->
    </div>
    <div class="6u$ 12u$(3)" style="display: inline">
        <!--                <input type="email" name="email" id="demo-email" value="" placeholder="邮箱" />-->
        <div style="float:left;width: 50%;">
            <!--                <input type="text" name="verifyCode" value="" placeholder="验证码" style="" />-->
            <?= $form->field($contactForm, 'verifyCode')->widget(Captcha::className(),['options' => ['placeholder' => '验证码']])->label(false) ?>
        </div>
        <div style="float:left;width: 40%;">
            <?php
            //                echo Captcha::widget(['name'=>'captchaimg','captchaAction'=>'site/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;margin-left:25px;'],'template'=>'{image}']);//我这里写的跟官方的不一样，因为我这里加了一个参数(login/captcha),这个参数指向你当前控制器名，如果不加这句，就会找到默认的site控制器上去，验证码会一直出不来，在style里是可以写css代码的，可以调试样式 ?>
        </div>
    </div>
    <div class="12u$">
        <ul class="actions">
            <input type="hidden"  value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf-frontend" />
            <li>
                <input type="submit" value="提交" class="special" id="submit_content" src="/index.php?r=site/contact"/>
            </li>
            <li><input type="reset" value="重填" id="reset-form" src="/index.php?r=site/contact"/></li>
        </ul>
    </div>
</div>
<!--    </form>-->
<?php ActiveForm::end(); ?>

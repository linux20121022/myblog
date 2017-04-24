<?php
namespace frontend\controllers;

use common\models\Article;
use GuzzleHttp\Psr7\Response;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\ContactForm;
use common\models\User;
use yii\helpers\StringHelper;
use yii\helpers\Html;
use common\models\ArticleStatus;
use common\models\Comment;
use dodgepudding\wechat\sdk\Wechat as wechat;

/**
 * Site controller
 */
$options = array(
    'token'=>'weixin', //填写你设定的key
    'encodingaeskey'=>'' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
);

$weObj = new Wechat($options);
$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
$type = $weObj->getRev()->getRevType();
switch($type) {
    case Wechat::MSGTYPE_TEXT:
        $weObj->text("hello, I'm wechat")->reply();
        exit;
        break;
    case Wechat::MSGTYPE_EVENT:
        break;
    case Wechat::MSGTYPE_IMAGE:
        break;
    default:
        $weObj->text("help info")->reply();
}
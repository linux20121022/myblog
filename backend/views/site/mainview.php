
<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//AppAsset::addCss($this,'@web/css/b_login.js');
$this->registerCssFile('@web/css/rightmain.css');
?>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 illu">
            <dl>
                <dt>我的个人信息</dt>
                <dd>
                    <ul>
                        <li>你好，<?= Yii::$app->user->identity->username?></li>
                        <li>上次登录时间：<?= Yii::$app->user->identity->last_login_time?></li>
                        <li>上次登录IP：<?= Yii::$app->user->identity->last_login_ip?> </li>
                    </ul>
                </dd>
            </dl>

        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 illu">
            <dl>
                <dt>信息统计</dt>
                <dd>
                    <ul>
                        <li>会员数：20000</li>
                        <li>文章数：10000</li>
                        <li>评论数：50002</li>
                        <li>商品数：50002</li>
                    </ul>
                </dd>
            </dl>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 illu">
            <dl>
                <dt>系统信息</dt>
                <dd>
                    <ul>
                        <li>程序版本：V1.0 [20170118]</li>
                        <li>操作系统：<?= PHP_OS;?></li>
                        <li>服务器软件：<?PHP echo $_SERVER ['SERVER_SOFTWARE']; ?></li>
<!--                        <li>MySQL 版本：--><?//= mysql_get_server_info(); ?><!--</li>-->
                        <li>上传文件：<?PHP echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></li>
                    </ul>
                </dd>
            </dl>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 illu">
            <dl>
                <dt>网站信息</dt>
                <dd>
                    <ul>
                        <li>版权所有：XXXX系统</li>
                        <li>官方网站：http://www.mycodes.net</li>
                        <li>官方论坛：http://bbs.xxx.com</li>
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
    <!-- 第一行结束 -->
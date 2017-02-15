<?php

use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
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
<!--    <ul class="actions">-->
<!--        <li><a href="#" class="button">Learn More</a></li>-->
<!--    </ul>-->
</section>

<!-- Two -->
<section id="two">
    <h2>图文列表</h2>
    <div class="row" id="pic_list">
        <?php foreach($pic as $key=>$val) { ?>
            <a href="<?php echo Url::to(["site/view",'id'=> $val->id])?>" target="_blank">
            <article class="6u 12u$(3) work-item">
                <img style="width:312px;height: 182px" src="<?php echo Yii::$app->params['adminUrl'] .$val->img_src?>" alt="" />
                    <h3><?php echo $val->title?>11</h3>
                    <p><?php echo StringHelper::truncate_utf8_string(html::decode($val->content),25) ?></p>
            </article>
            </a>

        <?php }?>
<!--        <article class="6u$ 12u$(3) work-item">-->
<!--            <a href="images/fulls/02.jpg" class="image fit thumb"><img src="images/thumbs/02.jpg" alt="" /></a>-->
<!--            <h3>Ultricies lacinia interdum</h3>-->
<!--            <p>Lorem ipsum dolor sit amet nisl sed nullam feugiat.</p>-->
<!--        </article>-->
<!--        <article class="6u 12u$(3) work-item">-->
<!--            <a href="images/fulls/03.jpg" class="image fit thumb"><img src="images/thumbs/03.jpg" alt="" /></a>-->
<!--            <h3>Tortor metus commodo</h3>-->
<!--            <p>Lorem ipsum dolor sit amet nisl sed nullam feugiat.</p>-->
<!--        </article>-->
<!--        <article class="6u$ 12u$(3) work-item">-->
<!--            <a href="images/fulls/04.jpg" class="image fit thumb"><img src="images/thumbs/04.jpg" alt="" /></a>-->
<!--            <h3>Quam neque phasellus</h3>-->
<!--            <p>Lorem ipsum dolor sit amet nisl sed nullam feugiat.</p>-->
<!--        </article>-->
<!--        <article class="6u 12u$(3) work-item">-->
<!--            <a href="images/fulls/05.jpg" class="image fit thumb"><img src="images/thumbs/05.jpg" alt="" /></a>-->
<!--            <h3>Nunc enim commodo aliquet</h3>-->
<!--            <p>Lorem ipsum dolor sit amet nisl sed nullam feugiat.</p>-->
<!--        </article>-->
<!--        <article class="6u$ 12u$(3) work-item">-->
<!--            <a href="images/fulls/06.jpg" class="image fit thumb"><img src="images/thumbs/06.jpg" alt="" /></a>-->
<!--            <h3>Risus ornare lacinia</h3>-->
<!--            <p>Lorem ipsum dolor sit amet nisl sed nullam feugiat.</p>-->
<!--        </article>-->
    </div>
    <ul class="actions">
        <form action="" id="page_action">
        <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" id="id_csrf" name="_csrf-frontend" >
        <input type="hidden" value="1" id="page_data" name="p" >
        <li><a href="javascript:void(0);" class="button" page="1" src="/index.php?r=site/ajaxlist" id="next_page">点击加载更多</a></li>
        </form>
    </ul>
</section>

<!--<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>-->

<!-- Three -->
<!--<section id="three">-->
<!--    <h2>Get In Touch</h2>-->
<!--    <p>Accumsan pellentesque commodo blandit enim arcu non at amet id arcu magna. Accumsan orci faucibus id eu lorem semper nunc nisi lorem vulputate lorem neque lorem ipsum dolor.</p>-->
<!--    <div class="row">-->
<!--        <div class="8u 12u$(2)">-->
<!--            <form method="post" action="#">-->
<!--                <div class="row uniform 50%">-->
<!--                    <div class="6u 12u$(3)"><input type="text" name="name" id="name" placeholder="Name" /></div>-->
<!--                    <div class="6u$ 12u$(3)"><input type="email" name="email" id="email" placeholder="Email" /></div>-->
<!--                    <div class="12u$"><textarea name="message" id="message" placeholder="Message" rows="4"></textarea></div>-->
<!--                </div>-->
<!--            </form>-->
<!--            <ul class="actions">-->
<!--                <li><input type="submit" value="Send Message" /></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="4u$ 12u$(2)">-->
<!--            <ul class="labeled-icons">-->
<!--                <li>-->
<!--                    <h3 class="icon fa-home"><span class="label">Address</span></h3>-->
<!--                    1234 Somewhere Rd.<br />-->
<!--                    Nashville, TN 00000<br />-->
<!--                    United States-->
<!--                </li>-->
<!--                <li>-->
<!--                    <h3 class="icon fa-mobile"><span class="label">Phone</span></h3>-->
<!--                    000-000-0000-->
<!--                </li>-->
<!--                <li>-->
<!--                    <h3 class="icon fa-envelope-o"><span class="label">Email</span></h3>-->
<!--                    <a href="#">hello@untitled.tld</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- Four -->

<section id="four">
<h2>文章</h2>

<section>
    <div id="art_list">
    <?php foreach($artList as $key=>$val){ ?>
        <a href="<?php echo Url::to(["site/view",'id'=> $val->id]);?>">
    <h4><?php echo $val->title?></h4>
    <p><?php echo StringHelper::truncate_utf8_string(html::decode($val->content),80) ?></p>
        </a>
    <?php }?>
    </div>
    <ul class="actions">
        <form action="" id="page_art_action">
            <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf-frontend" >
            <input type="hidden" value="1" id="page_art_data" name="p" >
            <li><a href="javascript:void(0);" class="button" page="1" src="/index.php?r=site/ajaxartlist" id="next_art_page">点击加载更多</a></li>
        </form>
    </ul>
</section>
<!---->
<!--<section>-->
<!--    <h4>Lists</h4>-->
<!--    <div class="row">-->
<!--        <div class="6u 12u$(3)">-->
<!--            <h5>Unordered</h5>-->
<!--            <ul>-->
<!--                <li>Dolor pulvinar etiam magna etiam.</li>-->
<!--                <li>Sagittis adipiscing lorem eleifend.</li>-->
<!--                <li>Felis enim feugiat dolore viverra.</li>-->
<!--            </ul>-->
<!--            <h5>Alternate</h5>-->
<!--            <ul class="alt">-->
<!--                <li>Dolor pulvinar etiam magna etiam.</li>-->
<!--                <li>Sagittis adipiscing lorem eleifend.</li>-->
<!--                <li>Felis enim feugiat dolore viverra.</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="6u$ 12u$(3)">-->
<!--            <h5>Ordered</h5>-->
<!--            <ol>-->
<!--                <li>Dolor pulvinar etiam magna etiam.</li>-->
<!--                <li>Etiam vel felis at lorem sed viverra.</li>-->
<!--                <li>Felis enim feugiat dolore viverra.</li>-->
<!--                <li>Dolor pulvinar etiam magna etiam.</li>-->
<!--                <li>Etiam vel felis at lorem sed viverra.</li>-->
<!--                <li>Felis enim feugiat dolore viverra.</li>-->
<!--            </ol>-->
<!--            <h5>Icons</h5>-->
<!--            <ul class="icons">-->
<!--                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>-->
<!--                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>-->
<!--                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>-->
<!--                <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>-->
<!--                <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>-->
<!--                <li><a href="#" class="icon fa-tumblr"><span class="label">Tumblr</span></a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--    <h5>Actions</h5>-->
<!--    <ul class="actions">-->
<!--        <li><a href="#" class="button special">Default</a></li>-->
<!--        <li><a href="#" class="button">Default</a></li>-->
<!--    </ul>-->
<!--    <ul class="actions small">-->
<!--        <li><a href="#" class="button special small">Small</a></li>-->
<!--        <li><a href="#" class="button small">Small</a></li>-->
<!--    </ul>-->
<!--    <div class="row">-->
<!--        <div class="6u 12u$(2)">-->
<!--            <ul class="actions vertical">-->
<!--                <li><a href="#" class="button special">Default</a></li>-->
<!--                <li><a href="#" class="button">Default</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="6u$ 12u$(2)">-->
<!--            <ul class="actions vertical small">-->
<!--                <li><a href="#" class="button special small">Small</a></li>-->
<!--                <li><a href="#" class="button small">Small</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="6u 12u$(2)">-->
<!--            <ul class="actions vertical">-->
<!--                <li><a href="#" class="button special fit">Default</a></li>-->
<!--                <li><a href="#" class="button fit">Default</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="6u$ 12u$(2)">-->
<!--            <ul class="actions vertical small">-->
<!--                <li><a href="#" class="button special small fit">Small</a></li>-->
<!--                <li><a href="#" class="button small fit">Small</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!--<section>-->
<!--    <h4>Table</h4>-->
<!--    <h5>Default</h5>-->
<!--    <div class="table-wrapper">-->
<!--        <table>-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>Name</th>-->
<!--                <th>Description</th>-->
<!--                <th>Price</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <td>Item One</td>-->
<!--                <td>Ante turpis integer aliquet porttitor.</td>-->
<!--                <td>29.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Two</td>-->
<!--                <td>Vis ac commodo adipiscing arcu aliquet.</td>-->
<!--                <td>19.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Three</td>-->
<!--                <td> Morbi faucibus arcu accumsan lorem.</td>-->
<!--                <td>29.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Four</td>-->
<!--                <td>Vitae integer tempus condimentum.</td>-->
<!--                <td>19.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Five</td>-->
<!--                <td>Ante turpis integer aliquet porttitor.</td>-->
<!--                <td>29.99</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--            <tfoot>-->
<!--            <tr>-->
<!--                <td colspan="2"></td>-->
<!--                <td>100.00</td>-->
<!--            </tr>-->
<!--            </tfoot>-->
<!--        </table>-->
<!--    </div>-->
<!---->
<!--    <h5>Alternate</h5>-->
<!--    <div class="table-wrapper">-->
<!--        <table class="alt">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>Name</th>-->
<!--                <th>Description</th>-->
<!--                <th>Price</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <td>Item One</td>-->
<!--                <td>Ante turpis integer aliquet porttitor.</td>-->
<!--                <td>29.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Two</td>-->
<!--                <td>Vis ac commodo adipiscing arcu aliquet.</td>-->
<!--                <td>19.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Three</td>-->
<!--                <td> Morbi faucibus arcu accumsan lorem.</td>-->
<!--                <td>29.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Four</td>-->
<!--                <td>Vitae integer tempus condimentum.</td>-->
<!--                <td>19.99</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Item Five</td>-->
<!--                <td>Ante turpis integer aliquet porttitor.</td>-->
<!--                <td>29.99</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--            <tfoot>-->
<!--            <tr>-->
<!--                <td colspan="2"></td>-->
<!--                <td>100.00</td>-->
<!--            </tr>-->
<!--            </tfoot>-->
<!--        </table>-->
<!--    </div>-->
<!--</section>-->

<!--<section>-->
<!--    <h4>Buttons</h4>-->
<!--    <ul class="actions">-->
<!--        <li><a href="#" class="button special">Special</a></li>-->
<!--        <li><a href="#" class="button">Default</a></li>-->
<!--    </ul>-->
<!--    <ul class="actions">-->
<!--        <li><a href="#" class="button big">Big</a></li>-->
<!--        <li><a href="#" class="button">Default</a></li>-->
<!--        <li><a href="#" class="button small">Small</a></li>-->
<!--    </ul>-->
<!--    <ul class="actions fit">-->
<!--        <li><a href="#" class="button special fit">Fit</a></li>-->
<!--        <li><a href="#" class="button fit">Fit</a></li>-->
<!--    </ul>-->
<!--    <ul class="actions fit small">-->
<!--        <li><a href="#" class="button special fit small">Fit + Small</a></li>-->
<!--        <li><a href="#" class="button fit small">Fit + Small</a></li>-->
<!--    </ul>-->
<!--    <ul class="actions">-->
<!--        <li><a href="#" class="button special icon fa-download">Icon</a></li>-->
<!--        <li><a href="#" class="button icon fa-download">Icon</a></li>-->
<!--    </ul>-->
<!--    <ul class="actions">-->
<!--        <li><span class="button special disabled">Special</span></li>-->
<!--        <li><span class="button disabled">Default</span></li>-->
<!--    </ul>-->
<!--</section>-->

<section>
    <h4>联系方式</h4>
    <div id="contractForm">

    </div>
    <div id="success-msg" style="text-align: center;display: none;">留言成功</div>
</section>

<!--<section>-->
<!--    <h4>Image</h4>-->
<!--    <h5>Fit</h5>-->
<!--    <div class="box alt">-->
<!--        <div class="row 50% uniform">-->
<!--            <div class="12u$"><span class="image fit"><img src="images/fulls/05.jpg" alt="" /></span></div>-->
<!--            <div class="4u"><span class="image fit"><img src="images/thumbs/01.jpg" alt="" /></span></div>-->
<!--            <div class="4u"><span class="image fit"><img src="images/thumbs/02.jpg" alt="" /></span></div>-->
<!--            <div class="4u$"><span class="image fit"><img src="images/thumbs/03.jpg" alt="" /></span></div>-->
<!--            <div class="4u"><span class="image fit"><img src="images/thumbs/04.jpg" alt="" /></span></div>-->
<!--            <div class="4u"><span class="image fit"><img src="images/thumbs/05.jpg" alt="" /></span></div>-->
<!--            <div class="4u$"><span class="image fit"><img src="images/thumbs/06.jpg" alt="" /></span></div>-->
<!--            <div class="4u"><span class="image fit"><img src="images/thumbs/03.jpg" alt="" /></span></div>-->
<!--            <div class="4u"><span class="image fit"><img src="images/thumbs/02.jpg" alt="" /></span></div>-->
<!--            <div class="4u$"><span class="image fit"><img src="images/thumbs/01.jpg" alt="" /></span></div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <h5>Left &amp; Right</h5>-->
<!--    <p><span class="image left"><img src="images/avatar.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>-->
<!--    <p><span class="image right"><img src="images/avatar.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>-->
<!--</section>-->

</section>
</div>
<?php $this->registerJsFile('@web/js/jquery.min.js');?>
<?php $this->registerJsFile('@web/js/jquery.poptrox.min.js');?>
<?php $this->registerJsFile('@web/js/skel.min.js');?>
<?php $this->registerJsFile('@web/js/init.js');?>
<?php $this->registerJsFile('@web/js/common.js');?>

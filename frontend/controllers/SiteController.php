<?php
namespace frontend\controllers;

use common\models\Article;
use GuzzleHttp\Psr7\Response;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User;
use yii\helpers\StringHelper;
use yii\helpers\Html;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $user = User::findOne(1);
        $picList = Article::indexPicList();
        $artList = Article::indexList();
        return $this->render('index',[
            'user' => $user,
            'pic' => $picList,
            'artList' => $artList
        ]);
    }

    /**
     * @desc 图文列表
     * @return array
     */
    public function actionAjaxlist()
    {
        Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
        $p = Yii::$app->request->post('p');
        $picList = Article::indexPicList($p);
        $picData = array();
        foreach($picList as $key=>$val){
            $picData[$key]['img_src'] =  Yii::$app->params['adminUrl'] .$val->img_src;
            $picData[$key]['tags'] = $val->tags;
            $picData[$key]['title'] = StringHelper::truncate_utf8_string(Html::decode($val->title),20);
            $picData[$key]['content'] = StringHelper::truncate_utf8_string(Html::decode($val->content),25);
            $picData[$key]['id'] = $val->id;
        }
        return ['code'=>1,'msg'=>'成功','data'=>$picData];
    }

    /**
     * @desc 纯文字列表
     * @return array
     */
    public  function actionAjaxartlist(){
        Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;
        $p = Yii::$app->request->post('p');
        $picList = Article::indexList($p);
        $picData = array();
        foreach($picList as $key=>$val){
//            $picData[$key]['img_src'] =  Yii::$app->params['adminUrl'] .$val->img_src;
            $picData[$key]['tags'] = $val->tags;
            $picData[$key]['title'] = StringHelper::truncate_utf8_string(Html::decode($val->title),20);
            $picData[$key]['content'] = StringHelper::truncate_utf8_string(Html::decode($val->content),25);
            $picData[$key]['id'] = $val->id;
        }
        return ['code'=>1,'msg'=>'成功','data'=>$picData];
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}

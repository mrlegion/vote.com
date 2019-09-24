<?php

namespace app\controllers;

use app\models\FoundForm;
use app\models\RegisterForm;
use app\models\User;
use app\models\Vote;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
     * Displays homepage
     */
    public function actionIndex()
    {
        $model = new FoundForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                return $this->redirect(['site/found', 'model' => $model]);
            }
        }
        return $this->render('index', compact('model'));
    }

    /**
     *  Displays registration form in program
     *
     * @return string
     */
    public function actionRegister(): string
    {
        $user = new User();
        $vote = new Vote();
        $model = new RegisterForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    return $this->redirect('/site/index');
                }
            }
        }
        return $this->render('register', compact('model'));
    }

    public function actionFound()
    {
        $model = Yii::$app->request->get('model');

        return $this->render('found', compact('model'));
    }


}

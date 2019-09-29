<?php

namespace app\controllers;

use app\models\FoundForm;
use app\models\RegisterForm;
use app\models\RegisterService;
use app\models\User;
use app\models\Vote;
use RuntimeException;
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
    public function actionRegister()
    {
        $model = new RegisterForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $service = new RegisterService();

                try {
                    $user = $service->singup($model);
                    Yii::$app->session->setFlash('success', 'Check your email to confirm the registration.');
                    $service->sendEmail($user);
                    return $this->redirect(['site/register-success', 'email' => $model->email]);
                } catch (RuntimeException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
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

    public function actionEmailConfirm($token)
    {
        $service = new RegisterService();
        try {
            $service->confirmation($token);
        } catch (RuntimeException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->render('email-confirm');
    }

    public function actionRegisterSuccess()
    {
        return $this->render('success', ['email' => Yii::$app->request->get('email')]);
    }


}

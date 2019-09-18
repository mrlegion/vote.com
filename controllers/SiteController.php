<?php

namespace app\controllers;

use app\models\FoundForm;
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
        $model = null;
        return $this->render('register', compact('model'));
    }

    public function actionFound()
    {
        $model = $this->get_json([]);

        foreach ($model[0]->children as $child) {
            // get info
        }

        return $this->render('found', compact('model', 'three'));
    }

    function normJsonStr($str){
        $str = preg_replace_callback('/\\\\u([a-f0-9]{4})/i', create_function('$m', 'return chr(hexdec($m[1])-1072+224);'), $str);
        return iconv('cp1251', 'utf-8', $str);
    }

    function get_json(array $post, $useGet = false) {
        //get json
        $connection = curl_init();
        $url = 'http://cikrf.ru/services/lk_tree/';
        if ($useGet) {
            $url .= '?';
            foreach ($post as $key => $value)
                $url .= $key . '=' . $value . '&';
            $url = rtrim($url, '&');
        }
        curl_setopt($connection, CURLOPT_URL, $url);
        if (!$useGet)
            curl_setopt($connection, CURLOPT_POSTFIELDS, $post);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
        curl_setopt($connection, CURLOPT_TIMEOUT, 20);

        $json_return = $this->normJsonStr(curl_exec($connection));

        curl_close($connection);

        return json_decode($json_return);
    }


}

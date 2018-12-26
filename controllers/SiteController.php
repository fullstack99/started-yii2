<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadImageForm;
use app\models\MyUser;

class SiteController extends Controller
{
    // public $layout = "newlayout";  // set layout
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $date = date('Y-m-d H:i:s');
        return $this->render('about', [
            'date' => $date
        ]);
    }

    /* other code */ 
    public function actionSpeak($message = "default message") { 
        return $this->render("speak", [
            'message' => $message
        ]); 
    }

    public function actionRoutes() {
       return $this->render('routes');
    }

    public function actionOpenAndCloseSession() {
       $session = Yii::$app->session;
       // open a session
       $session->open();
       // check if a session is already opened
       if ($session->isActive) echo "session is active";
       // close a session
       $session->close();
       // destroys all data registered to a session
       $session->destroy();
    }

    public function actionShowFlash() {
       $session = Yii::$app->session;
       // set a flash message named as "greeting"
       $session->setFlash('greeting', 'Hello user!');
       return $this->render('showflash');
    }

    public function actionUploadImage() {
        $model = new UploadImageForm();
        $session = Yii::$app->session;
        $session->destroy();
        if (Yii::$app->request->isPost) {
           
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                // file is uploaded successfully
              
                // set a flash message named as "greeting"
                $session->setFlash('greeting', 'File successfully uploaded');
                return $this->refresh();
            }
        }
        return $this->render('upload', ['model' => $model]);
    }

    public function actionPagination() {
       //preparing the query
       $query = MyUser::find();
       // get the total number of users
       $count = $query->count();
       //creating the pagination object
       $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 10]);
       //limit the query using the pagination and retrieve the users
       $models = $query->offset($pagination->offset)
          ->limit($pagination->limit)
          ->all();
       return $this->render('pagination', [
          'models' => $models,
          'pagination' => $pagination,
       ]);
    }
}

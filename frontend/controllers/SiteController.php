<?php
namespace frontend\controllers;

use frontend\models\SignupForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\News;
use yii\data\Pagination;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['new'],
                        'allow' => false,
                        'roles' => ['?'],
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
        if (isset($_GET['year'])){
            if (isset($_GET['month'])){
                $query = News::find()->where(['year(date)' => (integer)$_GET['year'],'month(date)' => (integer)$_GET['month']]);
            }
            else {
                $query = News::find()->where(['year(date)' => (integer)$_GET['year']]);
            }
        }
        elseif(isset($_GET['theme'])){
            $find_theme = News::find()->where(['id' => (integer)$_GET['theme']])->one();
            $query = News::find()->where(['theme' => addslashes($find_theme->theme)]);
        }
        else {
            $query = News::find();
        }

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $news = $query->orderBy(['date' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'news' => $news,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Logs in a admin.
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionView()
    {
        if (isset($_GET['id'])){
            $id = (integer)Yii::$app->request->get()['id'];
            $model = News::find()->where(['id' => $id])->one();
            return $this->render('view', [
                'model' => $model,
            ]);
        }
        else{
            $name = "Ошибка";
            $message = "Не указан ID новости!";
            return $this->render('error',[
                'name' => $name,
                'message' => $message]);
        }
    }

    public function actionEdit()
    {
        if (isset($_GET['id'])){
            $id = (integer)Yii::$app->request->get()['id'];
            $model = News::find()->where(['id' => $id])->one();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $name = Yii::$app->request->post()['News']['name'];
                $date = Yii::$app->request->post()['News']['date'];
                $theme = Yii::$app->request->post()['News']['theme'];
                $text = Yii::$app->request->post()['News']['text'];
                $model->name = $name;
                $model->date = $date;
                $model->theme = $theme;
                $model->text = $text;
                $model->update();
                return $this->redirect(['view','id'=>$model->id]);
            } else {
                return $this->render('edit', [
                    'model' => $model,
                ]);
            }
        }
        else{
            $name = "Ошибка";
            $message = "Не указан ID новости!";
            return $this->render('error',[
                'name' => $name,
                'message' => $message]);
        }
    }

    public function actionNew()
    {
        $model = new News();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $name = Yii::$app->request->post()['News']['name'];
            $date = Yii::$app->request->post()['News']['date'];
            $theme = Yii::$app->request->post()['News']['theme'];
            $text = Yii::$app->request->post()['News']['text'];
            $model->name = $name;
            $model->date = $date;
            $model->theme = $theme;
            $model->text = $text;
            $model->insert();
            return $this->redirect(['view','id'=>$model->id]);
        } else {
            $model->date = date("Y-m-d");
            return $this->render('new', [
                'model' => $model,
            ]);
        }
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

}

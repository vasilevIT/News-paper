<?php
namespace frontend\controllers;

use common\controllers\BehaviorsController;
use frontend\models\SignupForm;
use Yii;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\News;
use frontend\models\Theme;
use yii\data\Pagination;
use yii\web\ErrorAction;

/**
 * Class SiteController
 * @package frontend\controllers
 */
class SiteController extends BehaviorsController
{

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
        $query = News::find();
        if (isset($_GET['year'])){
            $query->andWhere(['year(date)' => (integer)$_GET['year']]);
        }
        if (isset($_GET['month'])){
            $query->andWhere(['month(date)' => (integer)$_GET['month']]);
        }
        if(isset($_GET['theme'])){
            $query->andWhere(['theme_id' => (integer)$_GET['theme']]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $news = $query->orderBy(['date' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit);
        $newsDataProvider = new ActiveDataProvider([
            'query' => $news,
            'pagination' => $pagination
        ]);

        return $this->render('index', [
            'newsDataProvider' => $newsDataProvider,
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

    public function actionEdit($id)
    {
        echo is($id);
        if (isset($id) && is_integer($id)){
            $model = News::find()->where(['id' => $id])->one();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view','id'=>$model->id]);
            } else {
                return $this->render('edit', [
                    'model' => $model,
                ]);
            }
        }
        else{
            throw new ErrorException('Не указан ID');
        }
    }

    public function actionNew()
    {
        $model = new News();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

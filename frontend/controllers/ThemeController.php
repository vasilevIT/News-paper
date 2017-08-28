<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:08
 */

namespace frontend\controllers;


use frontend\models\Themes;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class ThemeController extends Controller
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

    public function actionIndex(){
        $query = Themes::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $themes = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',['themes'=>$themes,'pagination' => $pagination]);
    }

    public function actionView(){
        if (isset($_GET['id'])){
            $model = Themes::find()->where(['id'=>(integer)$_GET['id']])->one();
            return $this->render('view',['model'=>$model]);
        }
    }

    public function actionEdit(){
        if (isset($_GET['id'])){
            $id = (integer)$_GET['id'];
            $model = Themes::find()->where(['id' => $id])->one();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $name = Yii::$app->request->post()['Themes']['name'];
                $model->name = $name;
                $model->update();
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                $model = Themes::find()->where(['id' => (integer)$_GET['id']])->one();
                return $this->render('edit', ['model' => $model]);
            }
        }
    }

    public function actionNew(){
        $model = new Themes;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $name = Yii::$app->request->post()['Themes']['name'];
            $model->name = $name;
            $model->insert();
            return $this->redirect(['view', 'id' => $model->id]);
        }else {
            return $this->render('new', ['model' => $model]);
        }

    }

}
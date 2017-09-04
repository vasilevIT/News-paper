<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:08
 */

namespace frontend\controllers;


use common\controllers\BehaviorsController;
use frontend\models\Theme;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class ThemeController extends BehaviorsController
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
        $query = Theme::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $themes = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit);

        $themeDataProvider = new ActiveDataProvider([
            'query' => $themes,
            'pagination' => $pagination
        ]);
        return $this->render('index',['themeDataProvider'=>$themeDataProvider]);
    }

    public function actionView(){
        if (isset($_GET['id'])){
            $model = Theme::find()->where(['id'=>(integer)$_GET['id']])->one();
            return $this->render('view',['model'=>$model]);
        }
    }

    public function actionEdit($id){
        if ($id){
            $model = Theme::find()->where(['id' => $id])->one();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                $model = Theme::find()->where(['id' => (integer)$_GET['id']])->one();
                return $this->render('edit', ['model' => $model]);
            }
        }
    }

    public function actionNew(){
        $model = new Theme;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else {
            return $this->render('new', ['model' => $model]);
        }

    }

}
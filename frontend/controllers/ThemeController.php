<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:08
 */

namespace frontend\controllers;


use common\controllers\BehaviorsController;
use frontend\models\Themes;
use Yii;
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

    public function actionEdit($id){
        if ($id){
            $model = Themes::find()->where(['id' => $id])->one();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                $model = Themes::find()->where(['id' => (integer)$_GET['id']])->one();
                return $this->render('edit', ['model' => $model]);
            }
        }
    }

    public function actionNew(){
        $model = new Themes;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else {
            return $this->render('new', ['model' => $model]);
        }

    }

}
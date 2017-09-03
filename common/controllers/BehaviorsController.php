<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04.09.17
 * Time: 0:08
 */

namespace common\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class BehaviorsController
 * @package common\controllers
 */
class BehaviorsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['index', 'error'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['login', 'error'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['theme'],
                        'actions' => ['index', 'error'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

}
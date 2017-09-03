<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04.09.17
 * Time: 0:08
 */

namespace common\controllers;


use Exception;
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
              /*  'denyCallback' => function($rule, $action){
                    throw new Exception('lox');
                },*/
                'only' => ['new', 'update', 'logout'],
                'rules' => [
                    [
                        'allow' => false,
                        'controllers' => ['site', 'theme'],
                        'actions' => ['new', 'update', 'logout'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site', 'theme'],
                        'actions' => ['new', 'update', 'logout'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

}
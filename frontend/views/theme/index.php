<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:10
 */
use frontend\models\Theme;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View
 * @var $themeDataProvider yii\data\ActiveDataProvider from frontend\controllers\ThemeController
 */

$this->title = 'Главная Темы';
?>
<h1>Темы</h1>

<?=\yii\grid\GridView::widget([
    'dataProvider' => $themeDataProvider,
    'columns' => [
        'id',
        'name',
        [
            'class' => 'yii\grid\ActionColumn',
        ]
    ]
])?>

<?php

use frontend\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View
 * @var $newsDataProvider yii\data\ActiveDataProvider from frontend\controllers\SiteController
 */

$this->title = 'Главная';
?>
<h1>News</h1>

<?=\yii\grid\GridView::widget([
    'dataProvider' => $newsDataProvider,
    'columns' => [
        'id',
        'date',
        'name',
        [
            'class' => 'yii\grid\DataColumn',
            'label' => 'Тема',
            'value' => function(News $model){
                return $model->getTheme()->name;
            }
        ],
        'text',
        [
            'class' => 'yii\grid\ActionColumn',
        ]
    ]
])?>

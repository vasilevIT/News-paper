<?php

use frontend\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<h1>News</h1>

<?=\yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
       'allModels' => $news
    ]),
    'columns' => [
        'id',
        'date',
        'name',
        [
            'label' => 'Тема',
            'value' => function(News $model){
                return $model->getTheme()->name;
            }
        ],
        'text',
        [
            'format' => 'raw',
            'value' => function(News $model){
            return Html::a('читать далее',Url::toRoute([ 'view', 'id' => $model->id]));
            }
        ]
    ]
])?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

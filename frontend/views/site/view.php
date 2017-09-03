<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Просмотр новости</h1>
<?=DetailView::widget([
    'model' => $model,
])?>

    <?=Html::a('редактировать',Url::toRoute([ 'edit', 'id' => $model->id])) ?>

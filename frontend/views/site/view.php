<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Просмотр новости</h1>
    <h3>Название новости: <?=$model->name?></h3>
    <p>Дата публикации: <?=$model->date?></p>
    <p>Тема: <?=$model->theme?></p>
    <p>Текст: <?=$model->text?></p>
    <br>
    <?=Html::a('редактировать',Url::toRoute([ 'edit', 'id' => $model->id])) ?>

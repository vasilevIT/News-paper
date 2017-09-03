<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:38
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'Новость';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Просмотр Темы</h1>
<p><?=Html::a('редактировать',Url::to(['theme/edit','id' => $model->id]))?></p>
<?=DetailView::widget([
    'model' => $model,
])?>


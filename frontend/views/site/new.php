<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\News */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Новая новость';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?=$this->title?></h1>

<?php $form = ActiveForm::begin(['id' => 'add-form']); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Название') ?>

<?= $form->field($model, 'date')->label('Дата') ?>

<?= $form->field($model, 'theme')->label('Тема') ?>

<?= $form->field($model, 'text')->textarea(['rows' => 6])->label('Тест');?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'news-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\News */

use frontend\models\Themes;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Редактирование новости</h1>

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Название') ?>

                <?= $form->field($model, 'date')->label('Дата') ?>

                <?= $form->field($model, 'theme_id')->dropDownList(
                    ArrayHelper::map(Themes::find()->all(),'id','name'),
            ['prompt'=>'Выберите тему']
       )->label('Тема')?>

                <?= $form->field($model, 'text')->textarea(['rows' => 6])->label('Тест');?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

<!--<input type="text" id="news-date">-->


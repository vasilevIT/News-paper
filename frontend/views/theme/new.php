<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:52
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Новая новость';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?=$this->title?></h1>

<?php $form = ActiveForm::begin(['id' => 'add-form']); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Название') ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'themes-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
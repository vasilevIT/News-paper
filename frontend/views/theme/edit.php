<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:37
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование темы';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Редактирование темы</h1>

<?php $form = ActiveForm::begin(['id' => 'theme-form']); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>
<?php ActiveForm::end(); ?>

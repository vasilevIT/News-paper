<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\News */

use frontend\models\Theme;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Новая новость';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?=$this->title?></h1>

<?php $form = ActiveForm::begin(['id' => 'add-form']); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'date') ?>

<?= $form->field($model, 'theme_id')->dropDownList(ArrayHelper::map(Theme::find()->all(),'id','name'),
    ['prompt'=>'Выберите тему']) ?>

<?= $form->field($model, 'text')->textarea(['rows' => 6]);?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'news-button']) ?>
    </div>
<?php ActiveForm::end(); ?>
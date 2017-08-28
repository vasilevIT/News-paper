<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:10
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Главная Темы';
?>
<h1>Темы</h1>
<ul>
    <?php foreach ($themes as $theme): ?>
        <li>
            Тема #<?=Html::encode($theme->id)?>: <?= Html::encode("{$theme->name}") ?> <?=Html::a('см',Url::to(['theme/view','id'=>$theme->id]))?><br>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

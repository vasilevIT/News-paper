<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<h1>News</h1>

<ul>
    <?php foreach ($news as $new): ?>
        <li>
            <?= Html::encode("{$new->name} ({$new->date})") ?><br>
            Тема: <?= Html::encode("{$new->theme->name}") ?><br>
            Статья: <?= substr($new->text,0,256) ?><?=strlen($new->text)>256?'...':''?>
            <?= Html::a('читать далее',Url::toRoute([ 'view', 'id' => $new->id]))?>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

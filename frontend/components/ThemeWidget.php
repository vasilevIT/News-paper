<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:23
 */

namespace app\components;


use frontend\models\Theme;
use yii\base\Widget;
use yii\helpers\Url;
use yii\widgets\Menu;

class ThemeWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message == null){
            $items = array();
            $rows = Theme::find()->all();
            foreach ($rows as $row){
                $items[] = [

                    'options' => ['class' => 'list-group-item list-group-item-action'],
                        'label' => $row->name . " ({$row->news_count})"
                    ,'url' => Url::to(['site/index','theme'=>$row->id])];
            }
            echo "<br><h3>Темы:</h3>";
            echo Menu::widget([
                'options' => ['class' => 'list-group'],
                'items' => $items,
                'submenuTemplate' => "\n<ul class='list-group'>\n{items}\n</ul>\n",
                'encodeLabels' => false, //allows you to use html in labels
                'activateParents' => true,   ]);

        }
    }

    public function run(){
        return $this->message;
    }
}
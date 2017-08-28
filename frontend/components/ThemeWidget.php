<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:23
 */

namespace app\components;


use frontend\models\Themes;
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
            $rows = Themes::find()->all();
            foreach ($rows as $row){
                $items[] = ['label' => $row->name . " ({$row->news_count})"
                    ,'url' => Url::to(['site/index','theme'=>$row->id])];
            }
            echo "<br><h3>Темы:</h3>";
            echo Menu::widget([
                'options' => ['class' => 'sidebar-menu treeview'],
                'items' => $items,
                'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                'encodeLabels' => false, //allows you to use html in labels
                'activateParents' => true,   ]);

        }
    }

    public function run(){
        return $this->message;
    }
}
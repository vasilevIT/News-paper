<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 1:20
 */

namespace app\components;

use yii\base\Widget;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

class DateWidget extends Widget{
    public $message;

    public function init(){
        parent::init();
        if ($this->message == null) {
            $years = array();
            $query = new Query;
            $query->select('count(*) as `count`,year(date) as `year`,month(date) as `month`')
                ->from('news')
                ->groupBy(["year(date)", "month(date)"]);
            $command = $query->createCommand();
            $rows = $command->queryAll();
            foreach ($rows as $row) {
                $years[$row['year']][$row['month']] = $row['count'];
            }
            $months_names = [
                1 => 'Январь',
                2 => 'Февраль',
                3 => 'Март',
                4 => 'Апрель',
                5 => 'Май',
                6 => 'Июнь',
                7 => 'Июль',
                8 => 'Август',
                9 => 'Сентябрь',
                10 => 'Октябрь',
                11 => 'Ноябрь',
                12 => 'Декабрь',
            ];
            $items = array();
            foreach ($years as $year => $months) {
                $items_months = array();
                foreach ($months as $month_num => $count_news) {
                    $monthLabel = $months_names[$month_num];
                    $items_months[] = [
                        'options' => ['class' => 'list-group-item list-group-item-action']
                        ,'label' => $monthLabel . " ({$count_news})"
                        ,'url' => Url::to(['site/index', 'year' => $year, 'month' => $month_num])
                    ];
                }
                $items[] = ['label' => $year
                    ,'options' => ['class' => 'list-group-item list-group-item-action']
                    , 'url' => Url::toRoute(["site/index", 'year' => $year])
                    , 'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>'
                    , 'items' => $items_months];

            }
            $this->message .= "<br><h3>Года:</h3>";
            $this->message .= Menu::widget([
                'options' => ['class' => 'list-group'],
                'items' => $items,
                'submenuTemplate' => "\n<ul class='list-group'>\n{items}\n</ul>\n",
                'encodeLabels' => false, //allows you to use html in labels
                'activateParents' => true,]);
        }

    }

    public function run(){
        return $this->message;
    }

}
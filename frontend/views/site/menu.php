<?php

use yii\db\Query;
use yii\widgets\Menu;
use yii\helpers\Url;
$years = array();
//years
$query = new Query;
$query->select('count(*) as `count`,year(date) as `year`')
    ->from('news')
    ->groupBy("year(date)");
$rows = $query->all();
$command = $query->createCommand();
$rows = $command->queryAll();
foreach ($rows as $row){
    $years[$row['year']] = array();
    $query = new Query;
    $query->select('count(*) as `count`,year(date) as `year`,month(date) as `month`')
        ->from('news')
        ->where(['year(`date`)' => $row['year']])
        ->groupBy("month(date)");
    // build and execute the query
    $rows_months = $query->all();
    // alternatively, you can create DB command and execute it
    $command = $query->createCommand();
    // $command->sql returns the actual SQL
    $rows_months = $command->queryAll();

    foreach ($rows_months as $row_month){
        $years[$row['year']][$row_month['month']] = $row_month['count'];
    }
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
    foreach ($months as $month_num => $count_news){
        $monthLabel = $months_names[$month_num];
        $items_months[] = ['label' => $monthLabel . " ({$count_news})"
            ,'url' => Url::toRoute(['index','year'=>$year
                                            ,'month'=>$month_num])];
    }
    $items[] = ['label' => $year
        ,'url' => Url::toRoute(["index",'year'=>$year])
        ,'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>'
        ,'items' => $items_months];

}
echo "<br><h3>Года:</h3>";
echo Menu::widget([
    'options' => ['class' => 'sidebar-menu treeview'],
    'items' => $items,
    'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
    'encodeLabels' => false, //allows you to use html in labels
    'activateParents' => true,   ]);

$items = array();
//years
$query = new Query;
$query->select('id, count(*) as `count`, theme')
    ->from('news')
    ->groupBy("theme");
$rows = $query->all();
$command = $query->createCommand();
$rows = $command->queryAll();
foreach ($rows as $row){
    $items[] = ['label' => $row['theme'] . " ({$row['count']})"
        ,'url' => Url::toRoute(['index','theme'=>$row['id']])];
}
echo "<br><h3>Темы:</h3>";
echo Menu::widget([
    'options' => ['class' => 'sidebar-menu treeview'],
    'items' => $items,
    'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
    'encodeLabels' => false, //allows you to use html in labels
    'activateParents' => true,   ]);
?>
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 0:24
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Themes extends ActiveRecord
{
    public static function tableName()
    {
        return 'themes';
    }

    public function getNews_count()
    {
        return News::find()->where(['theme_id' => $this->id])->count();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.08.17
 * Time: 0:24
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Theme extends ActiveRecord
{
    public static function tableName()
    {
        return 'theme';
    }

    public function rules()
    {
        return [
            ['name','required']
        ];
    }

    public function getNews_count()
    {
        return News::find()->where(['theme_id' => $this->id])->count();
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название'
        ];
    }

}
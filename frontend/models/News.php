<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.08.17
 * Time: 23:12
 */

namespace frontend\models;
use yii\db\ActiveRecord;

class News  extends ActiveRecord
{
    /*  public static function tableName()
      {
          return 'news';
      }
    */

    public function rules()
    {
        return [
            [['name','date','theme_id'], 'required'],
            ['text', 'string','max'=>500],
        ];
    }

    public function getTheme()
    {
        return $this->hasOne(Theme::className(), ['id' => 'theme_id'])->one();
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'theme_id' => 'Тема',
            'date' => 'Дата',
            'text' => 'Статья',
        ];
    }

}

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
            [['name','date','theme'], 'required'],
        ];
    }

    public function getTheme()
    {
        return $this->hasOne(Themes::className(), ['id' => 'theme_id']);
    }
}

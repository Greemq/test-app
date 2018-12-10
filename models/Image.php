<?php
/**
 * Created by PhpStorm.
 * User: VK
 * Date: 05.12.2018
 * Time: 22:16
 */

namespace app\models;


use yii\db\ActiveRecord;

class Image extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }

}
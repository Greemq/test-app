<?php
/**
 * Created by PhpStorm.
 * User: VK
 * Date: 01.12.2018
 * Time: 16:10
 */

namespace app\models;


use yii\base\Model;

class PhotoForm extends Model
{
    public $id;
    public $serviceId;
    public $description;
    public $smallImgUrl;
}
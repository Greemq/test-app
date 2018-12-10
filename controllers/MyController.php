<?php
/**
 * Created by PhpStorm.
 * User: VK
 * Date: 08.12.2018
 * Time: 13:45
 */

namespace app\controllers;

use app\models\SignupForm;
use app\models\User;
use linslin\yii2\curl\Curl;
use yii\web\Controller;
use app\models\Image;
use app\models\PhotoForm;
use yii\web\Response;

class MyController extends Controller
{
    public function actionIndex(){
        if (\Yii::$app->request->isAjax){
            \Yii::$app->response->format=Response::FORMAT_JSON;
            $response=$this->ApiConnectSearchPage(str_replace(' ',',',\Yii::$app->request->post()['search']),\Yii::$app->request->post()['page']);
            $a=\Yii::$app->request->post()['search'];
            $this->search($a);
            return $this->jsonToModel($response);
        }
        return $this->render('index');
    }

    public function actionImage(){
        $model=Image::findOne(\Yii::$app->request->get());
        return $this->render('image',['model'=>$model]);
    }

    public function jsonToModel($str){
        $obj=json_decode($str);
        $newObjArr=array();
        $imgArr=array();

        foreach ($obj->{'results'} as $res){
            $tmp=new PhotoForm();
            $tmp->serviceId=$res->{'id'};
            $tmp->description=$res->{'description'};
            $tmp->smallImgUrl=$res->{'urls'}->{'small'};
            $newObjArr[]=$tmp;
            if(!Image::find()->where(['service_id'=>$res->{'id'}])->exists()){
                array_push($imgArr,[null,$res->{'id'}]);
            }
        }
        \Yii::$app->db->createCommand()->batchInsert('image',['id','service_id'],$imgArr)->execute();
        foreach ($newObjArr as $tmp){
            $tmp->{'id'}=$this->getServiceId($tmp->serviceId);
        }
        return $newObjArr;
    }

    public function getServiceId($id){
        $tmp=Image::find()->where(['service_id'=>$id])->one();
        return $tmp->{'id'};
    }

    public function search($tmp){
        $a=preg_split('/[\s,]+/',$tmp);
        foreach ($a as $value){
            \Yii::$app->db->createCommand()->insert('log',['text'=>$value,'user_id'=>\Yii::$app->user->id])->execute();
        };
    }

    public function ApiConnectSearchPage($param,$page){
        $curl=new Curl();
        $response=$curl->get('https://api.unsplash.com/search/photos?client_id=8fe99082e019dfc753255285eda5dce720b786f7dc5c51b94ccdf6683cfdfdf7&page='.$page.'&per_page=20&query='.$param);
        return $response;
    }

    public function actionSignup(){
        if (!\Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model=new SignupForm();
        if ($model->load(\Yii::$app->request->post())&&$model->validate()){
            $user=new User();
            $user->username=$model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            if ($user->save()){
                return $this->goHome();
            };
        }
        return $this->render('signup',['model'=>$model]);
    }


}
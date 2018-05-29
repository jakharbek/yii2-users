<?php
/**
 * Created by PhpStorm.
 * User: Javharbek
 * Date: 20.02.2018
 * Time: 13:32
 */

namespace jakharbek\users\modules\user\controllers;

use Yii;
use yii\web\Controller;
use jakharbek\users\models\Tokens;
use jakharbek\users\models\Users;

class TokenController extends Controller
{
    public function actionConfirm($token = ""){
        if($model = Tokens::find()->token($token))
        {
            $user = Users::findOne($model->user_id);
            $user->emailConfirm();
            $user->save();
            $model->confirm();
            $model->save();
        }
        else{
            throw new \yii\web\NotFoundHttpException();
        }
        return $this->render('confirm',['token' => $token,'model' => $model]);
    }
    public function actionUnconfirm($token = ""){
        if($model = Tokens::find()->token($token))
        {
            $user = Users::findOne($model->user_id);
            $user->emailUnConfirm();
            $user->save();
            $model->unconfirm();
            $model->save();
        }
        else{
            throw new \yii\web\NotFoundHttpException();
        }
        return $this->render('unconfirm',['token' => $token,'model' => $model]);
    }
}
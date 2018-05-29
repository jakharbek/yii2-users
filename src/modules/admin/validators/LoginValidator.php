<?php
namespace jakharbek\users\modules\admin\validators;
use jakharbek\users\models\Users;
use Yii;
use yii\validators\Validator;
class LoginValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $login = $model->login;
        $login = strip_tags($model->login);
        $password = md5(strip_tags($model->password));
        if(!($user = $model->user = Users::find()->login($login)->one())):
            $this->addError($model,$attribute,Yii::t('jakhar-users','Login or passcode wrong'));
            return false;
        endif;
        if($user->user_status == Users::USER_STATUS_BLOCK):
            $this->addError($model,$attribute,Yii::t('jakhar-users','User is blocked'));
            return false;
        endif;
        if($password !== $user->password):
            $this->addError($model,$attribute,Yii::t('jakhar-users','Login or passcode wrong'));
            return false;
        endif;
        if($user->user_status == Users::USER_STATUS_DEFAULT):
            $this->addError($model,$attribute,Yii::t('jakhar-users','Your profile is not activated'));
        endif;
    }
}
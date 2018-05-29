<?php

namespace jakharbek\users\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Users]].
 *
 * @see Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[user_status]]='.Users::STATUS_ACTIVE);
    }

    /**
     * @inheritdoc
     * @return Users[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function login($login = null,$status = null){
        return parent::where(['login' => $login]);
    }
    public function statuses(){
        return [
            -1 => Yii::t('jakhar-users','Blocked'),
            0 => Yii::t('jakhar-users','Off'),
            1 => Yii::t('jakhar-users','Active'),
        ];
    }
}

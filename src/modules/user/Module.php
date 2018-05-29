<?php

namespace jakharbek\users\modules\user;

use Yii;
/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    const ALIAS = "@vendor/jakharbek/yii2-users/src";
    public $confirmLink = "";
    public $unConfirmLink = "";
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'jakharbek\users\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }


}

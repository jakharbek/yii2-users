<?php

namespace jakharbek\users\modules\admin;

use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    const ALIAS = "@vendor/jakharbek/yii2-users/src";
    public $confirmLink = "";
    public $unConfirmLink = "";
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'jakharbek\users\modules\admin\controllers';

    public $defaultRoute = "users";

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
/*
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['jakhar-users'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => self::ALIAS.'/messages',
            'fileMap' => [
                'jakhar-users' => 'main.php',
            ],
        ];
    }*/
}

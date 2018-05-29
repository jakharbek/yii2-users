<?php

namespace jakharbek\users;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface{
    const ALIAS = "@vendor/jakharbek/yii2-users/src";
    public function bootstrap($app)
    {
        $this->registerTranslations();
    }
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['jakhar-user'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => self::ALIAS.'/messages',
            'fileMap' => [
                'jakhar-user' => 'main.php',
            ],
        ];
    }
}
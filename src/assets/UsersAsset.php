<?php

namespace jakharbek\users\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class UsersAsset extends AssetBundle
{
    public $sourcePath = '@vendor/jakharbek/yii2-users/src/assets/web';

    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css',
        'https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900',
        'https://fonts.googleapis.com/css?family=Montserrat:400,700',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
        "css/style.css",

        ];

    public $js = [
        "js/index.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];
}



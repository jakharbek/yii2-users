<?php

namespace jakharbek\users\modules\user\controllers;

use jakharbek\users\modules\user\models\Users;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

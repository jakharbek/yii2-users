<?php
namespace jakharbek\users\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use jakharbek\users\models\Tokens;
use jakharbek\users\models\Users;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class LogoutController extends Controller
{
    public $layout = 'adminlogin';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    return Yii::$app->response->redirect(['/']);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        /**
         * @var Users $user
         */
        $user = Yii::$app->user->getIdentity();
        $user->logout();
        Yii::$app->user->logout();
        return $this->goHome();
    }


}
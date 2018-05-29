<?php
namespace jakharbek\users\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use jakharbek\users\models\Tokens;
use jakharbek\users\models\Users;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class LoginController extends Controller
{
    public $viewPath = '@vendor/jakharbek/yii2-users/src/modules/admin/views/login/index';
    public $layout = '@vendor/jakharbek/yii2-users/src/modules/admin/views/layouts/login';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?']
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

        $model = new Users(['scenario' => Users::SCENARIO_ADMIN_LOGIN]);
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $token = new Tokens(['scenario' => Tokens::SCENARIO_CREATE]);
                $token->type = Users::TOKEN_LOGIN;
                $token->user_id = $model->user->user_id;
                $token->save();
                if(Yii::$app->user->loginByAccessToken($token->token)){
                    return $this->goHome();
                }

            }
        }
       return $this->render($this->viewPath,['model' => $model,'token' => $token]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


}
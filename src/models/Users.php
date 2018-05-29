<?php

namespace jakharbek\users\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use jakharbek\users\modules\admin\validators\LoginValidator;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id Идентификатор пользователя
 * @property string $login Логин пользователя
 * @property string $password Пароль пользавателя
 * @property string $email Электронная почта пользавателя
 * @property string $phone Номер телефона пользавателя
 *
 * @property Attanment[] $attanments
 * @property Castings[] $castings
 * @property Files[] $files
 * @property Images[] $images
 * @property Pages[] $pages
 * @property Persons[] $persons
 * @property Posts[] $posts
 * @property Tokens[] $tokens
 * @property Topics[] $topics
 * @property Tvprogrammes[] $tvprogrammes
 * @property Tvprojects[] $tvprojects
 * @property Videos[] $videos
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const SCENARIO_ADMIN_CREATE = "ADMIN_CREATE";
    const SCENARIO_ADMIN_UPDATE = "ADMIN_UPDATE";
    const SCENARIO_ADMIN_LOGIN = "ADMIN_LOGIN";
    const USER_STATUS_DEFAULT = 0;
    const USER_STATUS_BLOCK = -1;
    const TOKEN_EMAIL_CONFIRM = 100;
    const TOKEN_PASSWORD_RESET = 101;
    const TOKEN_LOGIN = 102;
    const USER_LOGOUT = 0;

    public $password_original;
    public $password_temp;
    public $user;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email'], 'filter', 'filter'=>'strtolower'],
            [['login','password'], 'required','on' => [self::SCENARIO_ADMIN_LOGIN]],
            [['login'],LoginValidator::class,'on' => [self::SCENARIO_ADMIN_LOGIN]],
            [['login', 'email','password'], 'required','on' => [self::SCENARIO_ADMIN_CREATE]],
            [['login', 'email','password'], 'string', 'max' => 255,'on' => [self::SCENARIO_ADMIN_CREATE]],
            [['login', 'email'], 'required','on' => [self::SCENARIO_ADMIN_UPDATE]],
            [['login', 'email'], 'string', 'max' => 255,'on' => [self::SCENARIO_ADMIN_UPDATE]],
            [['password'], 'string', 'min' => 8,'on' => [self::SCENARIO_ADMIN_UPDATE]],
            [['phone'], 'string', 'max' => 15,'on' => [self::SCENARIO_ADMIN_CREATE,self::SCENARIO_ADMIN_UPDATE]],
            [['email'], 'unique','on' => [self::SCENARIO_ADMIN_CREATE,self::SCENARIO_ADMIN_UPDATE]],
            [['login'], 'unique','on' => [self::SCENARIO_ADMIN_CREATE,self::SCENARIO_ADMIN_UPDATE]],
            [['phone'], 'unique','on' => [self::SCENARIO_ADMIN_CREATE,self::SCENARIO_ADMIN_UPDATE]],
            [['user_status'],'default','value' => self::USER_STATUS_DEFAULT],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('jakhar-users','User ID'),
            'login' => Yii::t('jakhar-users','Login'),
            'password' => Yii::t('jakhar-users','Password'),
            'email' => Yii::t('jakhar-users','Email'),
            'phone' => Yii::t('jakhar-users','Phone'),
            'user_status' => Yii::t('jakhar-users','User Status')
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN_CREATE] = ['login','password','email','user_status','phone'];
        $scenarios[self::SCENARIO_ADMIN_UPDATE] = ['login','password','email','user_status','phone'];
        $scenarios[self::SCENARIO_ADMIN_LOGIN] = ['login','password'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttanments()
    {
        return $this->hasMany(Attanment::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCastings()
    {
        return $this->hasMany(Castings::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasMany(Persons::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Tokens::className(), ['user_id' => 'user_id']);
    }

    public function getToken(){
        return Tokens::find()->joinWith('user')->where(['tokens.status' => Tokens::STATUS_ACTIVE,'tokens.type' => Users::TOKEN_LOGIN,'users.user_id' => $this->getId()])->andWhere(['>', 'expire', time()])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topics::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvprogrammes()
    {
        return $this->hasMany(Tvprogrammes::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvprojects()
    {
        return $this->hasMany(Tvprojects::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Videos::className(), ['user_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $token = self::findOne($id)->token;
        $user = $token->user;
        return $user;
    }

    /**
     *
     */
    public function logout(){
        /**
         * @var Tokens $token
         */
        $token = $this->token;
        $token->setStatus(self::USER_LOGOUT);
        $token->save();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = Users::find()->joinWith('tokens')->where(['token' => $token,'status' => Tokens::STATUS_ACTIVE,'type' => Users::TOKEN_LOGIN])->andWhere(['>','user_status',Users::USER_STATUS_DEFAULT])->andWhere(['>', 'expire', time()])->one();
        return $user;
    }



    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return true;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public function setPassword($password = null){
        $this->password_original = $password;
        $this->password = md5($password);
    }
    public function beforeSave($insert){
        parent::beforeSave($insert);
        if($this->scenario == self::SCENARIO_ADMIN_CREATE) {
            $this->setPassword($this->password);
        }

        if($this->scenario == self::SCENARIO_ADMIN_UPDATE) {
            if (!(strlen($this->password) > 3)) {
                $this->password = $this->password_temp;
            }else{
                $this->setPassword($this->password);
            }
        }
        return true;
    }
    public function afterSave($insert,$changedAttributes){
        parent::afterSave($insert,$changedAttributes);
        //Создаём токен
        if($this->scenario == self::SCENARIO_ADMIN_CREATE):
            $token = $this->createTokenConfirmEmail();
        endif;
        if($this->scenario == self::SCENARIO_ADMIN_UPDATE):
            if(array_key_exists('email',$changedAttributes)):
                $this->setStatus(self::USER_STATUS_DEFAULT);
                $this->createTokenConfirmEmail();
            endif;
            if(array_key_exists('password',$changedAttributes)):
                $this->createNewPasswordAndSend();
            endif;
        endif;
        return $insert;
    }
    public function createNewPasswordAndSend(){

        try{
            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['email_from'])
                //->setTo($this->email)
                ->setTo(Yii::$app->params['email_from'])
                ->setSubject(Yii::t('jakhar-users','Confirm your email address'))
                ->setHtmlBody(Yii::$app->view->renderFile('@vendor/jakharbek/yii2-users/src/views/messages/emailresetpasswordadmin.php',['model' => $this]))
                ->send();
        }
        catch (\Exception $exp){
            echo $exp->getMessage();
        }
    }
    public function createTokenConfirmEmail(){
        $token = new Tokens(['scenario' => Tokens::SCENARIO_CREATE]);
        $token->user_id = $this->user_id;
        $token->type = self::TOKEN_EMAIL_CONFIRM;
        if($token->save()){
            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['email_from'])
                ->setTo($this->email)
                //->setTo(Yii::$app->params['email_from'])
                ->setSubject(Yii::t('jakhar-users','Confirm your email address'))
                ->setHtmlBody(Yii::$app->view->renderFile('@vendor/jakharbek/yii2-users/src/views/messages/emailconfirm.php',['token' => $token]))
                ->send();
            return $token;
        }else{
            return false;
        }
    }
    public function emailConfirm(){
        $this->user_status = self::STATUS_ACTIVE;
    }
    public function emailUnConfirm(){
        $this->user_status = self::USER_STATUS_DEFAULT;
    }
    public function setStatus($status = self::USER_STATUS_DEFAULT){
        $this->user_status = $status;
    }
    public function hasByLogin($login){

    }
    public function getUsername(){
        return $this->login;
    }

}

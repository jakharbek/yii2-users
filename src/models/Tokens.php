<?php

namespace jakharbek\users\models;

use Yii;

/**
 * This is the model class for table "tokens".
 *
 * @property int $token_id Идентификатор токена
 * @property int $user_id Владелец (пользователь) токена
 * @property string $token Токен
 * @property string $expire Дата и время истечение токена
 * @property int $status Статус токена
 *
 * @property Users $user
 */
class Tokens extends \yii\db\ActiveRecord
{
    //Токен активный
    const STATUS_ACTIVE = 1;
    //Токен уже использовался
    const STATUS_USED = 2;
    //Токен был ошибочна отправлен и его уже дактивировали
    const STATUS_ERROR = 3;

    const SCENARIO_CREATE = "CREATE_TOKEN";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => null],
            [['user_id', 'status'], 'integer'],
            [['expire','type'], 'safe'],
            [['token'], 'string', 'max' => 255],
            [['expire'], 'unique'],
            [['token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['status'],'default','value' => self::STATUS_ACTIVE],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['*'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token_id' => 'Идентификатор токена',
            'user_id' => 'Владелец (пользователь) токена',
            'token' => 'Токен',
            'expire' => 'Дата и время истечение токена',
            'status' => 'Статус токена',
            'type' => 'Тип'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return TokensQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TokensQuery(get_called_class());
    }

    //Сссылка на потверждение
    public function getConfirmLink(){
        return Yii::$app->controller->module->confirmLink."".$this->token;
    }
    //Сссылка на потверждение ошибки
    public function getUnConfirmLink(){
        return Yii::$app->controller->module->unConfirmLink."".$this->token;
    }

    /**
     * @return bool
     */
    public function beforeValidate(){
        parent::beforeValidate();
        if($this->scenario == self::SCENARIO_CREATE):
            if($this->isNewRecord):
                //Генерация токена
                $this->generateToken();
                //Установка срока токена
                $this->setExpireTime();
                //Установка статус токена как активный
                $this->setStatus();
            endif;
        endif;
        return true;
    }
    public function generateToken(){
        $this->token = Yii::$app->security->generateRandomString(30);
    }
    public function setExpireTime($expire_time = 864000){
        $this->expire = time() + $expire_time;
    }
    public function setStatus($status = self::STATUS_ACTIVE){
        $this->status = $status;
    }
    public function confirm(){
        $this->status = self::STATUS_USED;
    }
    public function unconfirm(){
        $this->status = self::STATUS_ERROR;
    }
}

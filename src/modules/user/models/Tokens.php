<?php

namespace jakharbek\users\modules\user\models;

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
class Tokens extends \jakharbek\users\models\Tokens
{

}

<?php

namespace jakharbek\users\modules\user\models;

use Yii;

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
class Users extends \jakharbek\users\models\Users
{

}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 * Таблица пользавателей в системе
 */
class m180216_083742_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            '[[user_id]]' => $this->primaryKey()->unique()->comment('Идентификатор пользователя'),
            '[[login]]' => $this->string(255)->notNull()->unique()->comment('Логин пользователя'),
            '[[password]]' => $this->string(255)->notNull()->comment('Пароль пользавателя'),
            '[[email]]' => $this->string(255)->notNull()->unique()->comment('Электронная почта пользавателя'),
            '[[phone]]' => $this->string(15)->unique()->comment('Номер телефона пользавателя'),
            '[[params]]' => $this->text()->comment('Параметры'),
            '[[user_status]]' => $this->integer(15)->comment('Статус'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}

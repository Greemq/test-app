<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181209_063426_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->unique(),
            'password'=>$this->string()
        ]);
        $deafult="INSERT INTO 'user' ('username','password') VALUES (['guest','guest'])";
        $this->execute($deafult);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}

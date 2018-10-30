<?php

use yii\db\Migration;


class m181030_082658_change_user_field_requirements extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%users}}', 'password_hash', $this->string());
        $this->alterColumn('{{%users}}', 'phone', $this->string());
    }

    public function down()
    {
        $this->alterColumn('{{%users}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'phone', $this->string()->notNull());
    }
}

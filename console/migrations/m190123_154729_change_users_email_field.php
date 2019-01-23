<?php

use yii\db\Migration;

/**
 * Class m190123_154729_change_users_email_field
 */
class m190123_154729_change_users_email_field extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%users}}', 'email', $this->string()->null());
    }

    public function down()
    {
        $this->alterColumn('{{%users}}', 'email', $this->string()->unique());
    }
}

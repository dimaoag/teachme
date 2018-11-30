<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_statuses`.
 */
class m181130_080657_create_course_statuses_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%course_statuses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%course_statuses}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_galleries`.
 */
class m181203_153000_create_course_galleries_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_galleries}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_galleries-course_id}}', '{{%course_galleries}}', 'course_id');

        $this->addForeignKey('{{%fk-course_galleries-course_id}}', '{{%course_galleries}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%course_galleries}}');
    }
}

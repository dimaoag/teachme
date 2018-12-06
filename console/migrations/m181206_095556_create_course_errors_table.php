<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_errors`.
 */
class m181206_095556_create_course_errors_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_errors}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull(),
            'message' => $this->text(),
            'status' => $this->integer()->null()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_errors-course_id}}', '{{%course_errors}}', 'course_id');

        $this->addForeignKey('{{%fk-course_errors-course_id}}', '{{%course_errors}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%course_errors}}');
    }
}

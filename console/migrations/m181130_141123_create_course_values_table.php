<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_values`.
 */
class m181130_141123_create_course_values_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_values}}', [
            'course_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-course_values}}', '{{%course_values}}', ['course_id', 'characteristic_id']);

        $this->createIndex('{{%idx-course_values-course_id}}', '{{%course_values}}', 'course_id');
        $this->createIndex('{{%idx-course_values-characteristic_id}}', '{{%course_values}}', 'characteristic_id');

        $this->addForeignKey('{{%fk-course_values-course_id}}', '{{%course_values}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-course_values-characteristic_id}}', '{{%course_values}}', 'characteristic_id', '{{%course_characteristics}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%course_values}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photos`.
 */
class m181130_140034_create_photos_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_photos}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_photos-course_id}}', '{{%course_photos}}', 'course_id');

        $this->addForeignKey('{{%fk-course_photos-course_id}}', '{{%course_photos}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%course_photos}}');
    }
}

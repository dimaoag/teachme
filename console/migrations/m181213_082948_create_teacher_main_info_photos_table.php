<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teacher_main_info_photos`.
 */
class m181213_082948_create_teacher_main_info_photos_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%teacher_main_info_photos}}', [
            'id' => $this->primaryKey(),
            'teacher_main_info_id' => $this->integer()->notNull(),
            'file' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-teacher_main_info_photos-teacher_main_info_id}}', '{{%teacher_main_info_photos}}', 'teacher_main_info_id');

        $this->addForeignKey('{{%fk-teacher_main_info_id-teacher_main_info_id}}', '{{%teacher_main_info_photos}}', 'teacher_main_info_id', '{{%teachers_main_info}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%teacher_main_info_photos}}');
    }
}

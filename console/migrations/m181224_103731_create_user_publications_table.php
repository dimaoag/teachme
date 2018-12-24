<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_publications`.
 */
class m181224_103731_create_user_publications_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%user_publications}}', [
            'course_type_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'quantity' => $this->string(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-user_publications}}', '{{%user_publications}}', ['user_id', 'course_type_id']);

        $this->createIndex('{{%idx-user_publications-course_type_id}}', '{{%user_publications}}', 'course_type_id');
        $this->createIndex('{{%idx-user_publications-user_id}}', '{{%user_publications}}', 'user_id');

        $this->addForeignKey('{{%fk-user_publications-course_type_id}}', '{{%user_publications}}', 'course_type_id', '{{%course_types}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('{{%fk-user_publications-user_id}}', '{{%user_publications}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-user_publications-course_type_id}}', '{{%user_publications}}');
        $this->dropForeignKey('{{%fk-user_publications-user_id}}', '{{%user_publications}}');

        $this->dropTable('{{%user_publications}}');
    }
}

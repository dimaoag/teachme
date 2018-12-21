<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_order_comments`.
 */
class m181221_132907_create_course_order_comments_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_order_comments}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'text' => $this->text(),
            'status' => $this->integer()->null(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_order_comments-order_id}}', '{{%course_order_comments}}', 'order_id');

        $this->addForeignKey('{{%fk-course_order_comments-order_id}}', '{{%course_order_comments}}', 'order_id', '{{%course_orders}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-course_order_comments-order_id}}', '{{%course_order_comments}}');

        $this->dropTable('{{%course_order_comments}}');
    }
}

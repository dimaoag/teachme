<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_orders`.
 */
class m181219_131409_create_course_orders_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_orders}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull(),
            'username' => $this->string(255),
            'phone' => $this->text()->notNull(),
            'title' => $this->text(),
            'price' => $this->float(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_orders-course_id}}', '{{%course_orders}}', 'course_id');

        $this->addForeignKey('{{%fk-course_orders-course_id}}', '{{%course_orders}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-course_orders-course_id}}', '{{%course_orders}}');

        $this->dropTable('{{%course_orders}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_reviews`.
 */
class m181218_101502_create_course_reviews_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_reviews}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'vote' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_reviews-user_id}}', '{{%course_reviews}}', 'user_id');

        $this->createIndex('{{%idx-course_reviews-course_id}}', '{{%course_reviews}}', 'course_id');

        $this->addForeignKey('{{%fk-course_reviews-user_id}}', '{{%course_reviews}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');

        $this->addForeignKey('{{%fk-course_reviews-course_id}}', '{{%course_reviews}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-course_reviews-user_id}}', '{{%course_reviews}}');

        $this->dropForeignKey('{{%fk-course_reviews-course_id}}', '{{%course_reviews}}');

        $this->dropTable('{{%course_reviews}}');
    }
}

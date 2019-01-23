<?php

use yii\db\Migration;

/**
 * Handles the creation of table `courses`.
 */
class m181130_105108_create_courses_table extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_courses}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'date_start_sale' => $this->integer()->unsigned()->null(),
            'date_stop_sale' => $this->integer()->unsigned()->null(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer(),
            'description' => $this->text(),
            'rating' => $this->decimal(3, 2),
            'status' => $this->integer(),
        ], $tableOptions);
        $this->createIndex('{{%idx-course_courses-category_id}}', '{{%course_courses}}', 'category_id');
        $this->createIndex('{{%idx-course_courses-user_id}}', '{{%course_courses}}', 'user_id');
        $this->createIndex('{{%idx-course_courses-city_id}}', '{{%course_courses}}', 'city_id');


        $this->addForeignKey('{{%fk-course_courses-category_id}}', '{{%course_courses}}', 'category_id', '{{%course_categories}}', 'id');
        $this->addForeignKey('{{%fk-course_courses-user_id}}', '{{%course_courses}}', 'user_id', '{{%users}}', 'id');
        $this->addForeignKey('{{%fk-course_courses-city_id}}', '{{%course_courses}}', 'city_id', '{{%course_cities}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%course_courses}}');
    }


}

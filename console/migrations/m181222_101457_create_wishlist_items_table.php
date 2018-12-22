<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wishlist_items`.
 */
class m181222_101457_create_wishlist_items_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%user_wishlist_items}}', [
            'user_id' => $this->integer()->notNull(),
            'course_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-user_wishlist_items}}', '{{%user_wishlist_items}}', ['user_id', 'course_id']);

        $this->createIndex('{{%idx-user_wishlist_items-user_id}}', '{{%user_wishlist_items}}', 'user_id');
        $this->createIndex('{{%idx-user_wishlist_items-course_id}}', '{{%user_wishlist_items}}', 'course_id');

        $this->addForeignKey('{{%fk-user_wishlist_items-user_id}}', '{{%user_wishlist_items}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-user_wishlist_items-course_id}}', '{{%user_wishlist_items}}', 'course_id', '{{%course_courses}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%user_wishlist_items}}');
    }
}

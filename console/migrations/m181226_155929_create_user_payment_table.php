<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_payment`.
 */
class m181226_155929_create_user_payment_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%user_payments}}', [
            'id' => $this->primaryKey(),
            'course_type_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'quantity' => $this->integer(),
            'sum' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer()->unsigned(),
        ], $tableOptions);

        $this->createIndex('{{%idx-user_payments-course_type_id}}', '{{%user_payments}}', 'course_type_id');
        $this->createIndex('{{%idx-user_payments-user_id}}', '{{%user_payments}}', 'user_id');

        $this->addForeignKey('{{%fk-user_payments-course_type_id}}', '{{%user_payments}}', 'course_type_id', '{{%course_types}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('{{%fk-user_payments-user_id}}', '{{%user_payments}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-user_payments-course_type_id}}', '{{%user_payments}}');
        $this->dropForeignKey('{{%fk-user_payments-user_id}}', '{{%user_payments}}');

        $this->dropTable('{{%user_payments}}');
    }
}

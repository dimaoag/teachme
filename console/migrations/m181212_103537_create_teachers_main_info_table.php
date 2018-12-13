<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teachers_main_info`.
 */
class m181212_103537_create_teachers_main_info_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%teachers_main_info}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'firm_name' => $this->string(255),
            'firm_photo' => $this->string(255),
            'address' => $this->string(255),
            'phone_1' => $this->string(255),
            'phone_2' => $this->string(255),
            'instagram_link' => $this->text()->null(),
            'facebook_link' => $this->text()->null(),
            'vk_link' => $this->text()->null(),
            'youtube_link' => $this->text()->null(),
            'created_at' => $this->integer()->unsigned(),

        ], $tableOptions);
        $this->createIndex('{{%idx-teachers_main_info-user_id}}', '{{%teachers_main_info}}', 'user_id');
        $this->createIndex('{{%idx-teachers_main_info-city_id}}', '{{%teachers_main_info}}', 'city_id');


        $this->addForeignKey('{{%fk-teachers_main_info-user_id}}', '{{%teachers_main_info}}', 'user_id', '{{%users}}', 'id','CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-teachers_main_info-city_id}}', '{{%teachers_main_info}}', 'city_id', '{{%course_cities}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%teachers_main_info}}');
    }
}

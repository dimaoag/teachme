<?php

use yii\db\Migration;

/**
 * Class m190131_072701_change_user_publication_foreight_keys
 */
class m190131_072701_change_user_publication_foreight_keys extends Migration
{

    public function up()
    {
        $this->dropForeignKey('{{%fk-user_publications-course_type_id}}', '{{%user_publications}}');
        $this->dropForeignKey('{{%fk-user_publications-user_id}}', '{{%user_publications}}');

        $this->addForeignKey('{{%fk-user_publications-course_type_id}}', '{{%user_publications}}', 'course_type_id', '{{%course_types}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-user_publications-user_id}}', '{{%user_publications}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-user_publications-course_type_id}}', '{{%user_publications}}');
        $this->dropForeignKey('{{%fk-user_publications-user_id}}', '{{%user_publications}}');

        $this->addForeignKey('{{%fk-user_publications-course_type_id}}', '{{%user_publications}}', 'course_type_id', '{{%course_types}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('{{%fk-user_publications-user_id}}', '{{%user_publications}}', 'user_id', '{{%users}}', 'id', 'RESTRICT', 'RESTRICT');
    }

}

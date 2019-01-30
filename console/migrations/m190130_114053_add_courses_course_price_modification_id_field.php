<?php

use yii\db\Migration;

/**
 * Class m190130_114053_add_courses_course_price_modification_id_field
 */
class m190130_114053_add_courses_course_price_modification_id_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_courses}}', 'price_modification_id', $this->integer()->null()->after('main_photo_id'));

        $this->createIndex('{{%idx-course_courses-price_modification_id}}', '{{%course_courses}}', 'price_modification_id');

        $this->addForeignKey('{{%fk-course_courses-price_modification_id}}', '{{%course_courses}}', 'price_modification_id', '{{%course_price_modifications}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-course_courses-price_modification_id}}', '{{%course_courses}}');

        $this->dropColumn('{{%course_courses}}', 'price_modification_id');
    }
}

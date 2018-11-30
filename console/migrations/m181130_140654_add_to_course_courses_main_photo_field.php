<?php

use yii\db\Migration;

/**
 * Class m181130_140654_add_to_course_courses_main_photo_field
 */
class m181130_140654_add_to_course_courses_main_photo_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_courses}}', 'main_photo_id', $this->integer()->after('city_id'));

        $this->createIndex('{{%idx-course_courses-main_photo_id}}', '{{%course_courses}}', 'main_photo_id');

        $this->addForeignKey('{{%fk-course_courses-main_photo_id}}', '{{%course_courses}}', 'main_photo_id', '{{%course_photos}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-course_courses-main_photo_id}}', '{{%course_courses}}');

        $this->dropColumn('{{%course_courses}}', 'main_photo_id');
    }
}

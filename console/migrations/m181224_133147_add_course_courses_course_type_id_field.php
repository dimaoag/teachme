<?php

use yii\db\Migration;

/**
 * Class m181224_133147_add_course_courses_course_type_id_field
 */
class m181224_133147_add_course_courses_course_type_id_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_courses}}', 'course_type_id', $this->integer()->after('city_id'));

        $this->createIndex('{{%idx-course_courses-course_type_id}}', '{{%course_courses}}', 'course_type_id');

        $this->addForeignKey('{{%fk-course_courses-course_type_id}}', '{{%course_courses}}', 'course_type_id', '{{%course_types}}', 'id', 'SET NULL', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-course_courses-course_type_id}}', '{{%course_courses}}');

        $this->dropColumn('{{%course_courses}}', 'course_type_id');
    }
}

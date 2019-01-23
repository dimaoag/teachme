<?php

use yii\db\Migration;

/**
 * Class m181213_100844_add_course_courses_firm_id_field
 */
class m181213_100844_add_course_courses_firm_id_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_courses}}', 'firm_id', $this->integer()->after('city_id'));

        $this->createIndex('{{%idx-course_courses-firm_id}}', '{{%course_courses}}', 'firm_id');

        $this->addForeignKey('{{%fk-course_courses-firm_id}}', '{{%course_courses}}', 'firm_id', '{{%teachers_main_info}}', 'id');
    }

    public function down()
    {

        $this->dropForeignKey('{{%fk-course_courses-firm_id}}', '{{%course_courses}}');
        $this->dropColumn('{{%course_courses}}', 'firm_id');
    }

}

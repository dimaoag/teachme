<?php

use yii\db\Migration;

/**
 * Class m190123_094756_add_course_courses_old_price_field
 */
class m190123_094756_add_course_courses_old_price_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_courses}}', 'old_price', $this->integer()->null()->after('price'));
    }

    public function down()
    {
        $this->dropColumn('{{%course_courses}}', 'old_price');
    }
}

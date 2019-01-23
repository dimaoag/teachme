<?php

use yii\db\Migration;

/**
 * Class m181220_080927_add_course_orders_teacher_id_field
 */
class m181220_080927_add_course_orders_teacher_id_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_orders}}', 'teacher_id', $this->integer()->after('course_id'));

        $this->createIndex('{{%idx-course_orders-teacher_id}}', '{{%course_orders}}', 'teacher_id');

        $this->addForeignKey('{{%fk-course_orders-teacher_id}}', '{{%course_orders}}', 'teacher_id', '{{%users}}', 'id');
    }

    public function down()
    {

        $this->dropForeignKey('{{%fk-course_orders-teacher_id}}', '{{%course_orders}}');
        $this->dropColumn('{{%course_orders}}', 'teacher_id');
    }
}

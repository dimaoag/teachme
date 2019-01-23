<?php

use yii\db\Migration;

/**
 * Class m190108_093619_add_course_category_photo_field
 */
class m190108_093619_add_course_category_photo_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_categories}}', 'cat_photo', $this->string(255)->after('name'));
    }

    public function down()
    {

        $this->dropColumn('{{%course_categories}}', 'cat_photo');
    }
}

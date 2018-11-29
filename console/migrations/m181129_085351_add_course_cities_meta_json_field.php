<?php

use yii\db\Migration;

/**
 * Class m181129_085351_add_course_cities_meta_json_field
 */
class m181129_085351_add_course_cities_meta_json_field extends Migration
{

    public function up()
    {
        $this->addColumn('{{%course_cities}}', 'meta_json', 'JSON NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%course_cities}}', 'meta_json');
    }

}

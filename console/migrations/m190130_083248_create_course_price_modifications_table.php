<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_price_modifications`.
 */
class m190130_083248_create_course_price_modifications_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_price_modifications}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%course_price_modifications}}');
    }
}

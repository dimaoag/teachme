<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_characteristics`.
 */
class m181129_103141_create_course_characteristics_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%course_characteristics}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'required' => $this->boolean()->notNull(),
            'variants_json' => 'JSON NOT NULL',
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%course_characteristics}}');
    }
}

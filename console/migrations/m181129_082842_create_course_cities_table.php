<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_cities`.
 */
class m181129_082842_create_course_cities_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%course_cities}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-course_cities-slug}}', '{{%course_cities}}', 'slug', true);
    }

    public function down()
    {
        $this->dropTable('{{%course_cities}}');
    }
}

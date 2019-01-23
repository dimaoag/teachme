<?php

use yii\db\Migration;

/**
 * Class m181224_090331_course_course_types_table
 */
class m181224_090331_course_course_types_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%course_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'price' => $this->integer(255),
            'sort' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%course_types}}');
    }

}

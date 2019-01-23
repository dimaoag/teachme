<?php

use yii\db\Migration;

/**
 * Class m181129_082910_rename_shop_categories_table
 */
class m181129_082910_rename_shop_categories_table extends Migration
{

    public function up()
    {
        $this->renameTable('{{%shop_categories}}', '{{%course_categories}}');
    }

    public function down()
    {
        $this->renameTable('{{%course_categories}}', '{{%shop_categories}}');
    }

}

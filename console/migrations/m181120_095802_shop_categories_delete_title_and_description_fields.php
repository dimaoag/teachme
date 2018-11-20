<?php

use yii\db\Migration;

/**
 * Class m181120_095802_shop_categories_delete_title_and_description_fields
 */
class m181120_095802_shop_categories_delete_title_and_description_fields extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%shop_categories}}', 'description');
        $this->dropColumn('{{%shop_categories}}', 'title');
    }

    public function down()
    {
        $this->addColumn('{{%shop_categories}}', 'title', $this->string()->after('slug'));
        $this->addColumn('{{%shop_categories}}', 'description', $this->text()->after('title'));
    }
}

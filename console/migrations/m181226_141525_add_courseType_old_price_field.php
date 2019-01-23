<?php

use yii\db\Migration;

/**
 * Class m181226_141525_add_courseType_old_price_field
 */
class m181226_141525_add_courseType_old_price_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course_types}}', 'old_price', $this->integer()->after('price'));


    }

    public function down()
    {
        $this->dropColumn('{{%course_types}}', 'old_price');
    }
}

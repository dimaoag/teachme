<?php

use yii\db\Migration;

/**
 * Class m181205_090424_add_users_publications_field
 */
class m181205_090424_add_users_publications_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%users}}', 'publications', $this->integer()->defaultValue(0)->null()->after('phone'));
    }

    public function down()
    {
        $this->dropColumn('{{%users}}', 'publications');
    }
}

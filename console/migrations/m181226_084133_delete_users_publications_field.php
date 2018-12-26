<?php

use yii\db\Migration;

/**
 * Class m181226_084133_delete_users_publications_field
 */
class m181226_084133_delete_users_publications_field extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%users}}', 'publications');

    }

    public function down()
    {

        $this->addColumn('{{%users}}', 'publications', $this->integer()->after('phone'));
    }

}

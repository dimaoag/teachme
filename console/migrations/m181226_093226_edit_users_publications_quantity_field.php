<?php

use yii\db\Migration;

/**
 * Class m181226_093226_edit_users_publications_quantity_field
 */
class m181226_093226_edit_users_publications_quantity_field extends Migration
{
    public function up(){
        $this->alterColumn('{{%user_publications}}', 'quantity', $this->integer());
    }

    public function down() {
        $this->alterColumn('{{%user_publications}}','quantity', $this->string(255));
    }
}

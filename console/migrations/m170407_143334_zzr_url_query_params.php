<?php

use yii\db\Migration;

class m170407_143334_zzr_url_query_params extends Migration
{
    public function up()
    {
        $this->createTable('zzr_url_query_params', [
            'id' => $this->primaryKey(),

            'parent_id' => $this->integer(),
            'level' => $this->smallInteger(),

            'name' => $this->string(),
            'value' => $this->string(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_url_query_params');
        echo "m170407_143334_zzr_url_query_params cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

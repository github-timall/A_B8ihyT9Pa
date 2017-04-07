<?php

use yii\db\Migration;

class m170407_143329_zzr_url_query extends Migration
{
    public function up()
    {
        $this->createTable('zzr_url_query', [
            'id' => $this->primaryKey(),

            'host' => $this->string(),
            'url' => $this->text(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_url_query');
        echo "m170407_143329_zzr_url_query cannot be reverted.\n";

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

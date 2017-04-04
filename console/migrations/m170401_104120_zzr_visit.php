<?php

use yii\db\Migration;

class m170401_104120_zzr_visit extends Migration
{
    public function up()
    {
        $this->createTable('zzr_visit', [
            'id' => $this->primaryKey(),

            'parent_id' => $this->integer(),
            'type' => $this->string(),

            'unique_id' => $this->integer(),
            'device_id' => $this->integer(),
            'referrer_id' => $this->integer(),

            'geo_code' => $this->string(),
            'ip' => $this->string(),
            'user_agent' => $this->string(),
            'headers' => $this->string(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_visit');
        echo "m170401_104120_zzr_visit cannot be reverted.\n";

        return true;
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
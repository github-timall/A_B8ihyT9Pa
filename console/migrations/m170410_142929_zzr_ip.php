<?php

use yii\db\Migration;

class m170410_142929_zzr_ip extends Migration
{
    public function up()
    {
        $this->createTable('zzr_ip', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(16),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        echo "m170410_142929_zzr_ip cannot be reverted.\n";

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

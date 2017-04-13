<?php

use yii\db\Migration;

class m170411_093049_zzr_ip_to_click extends Migration
{
    public function up()
    {
        $this->createTable('zzr_ip_to_click', [
            'click_id' => $this->integer(),
            'ip_id' => $this->integer(),
        ]);
        $this->addPrimaryKey('i2c', 'zzr_ip_to_click', ['click_id', 'ip_id']);
        $this->addForeignKey('i2c_click', 'zzr_ip_to_click', 'click_id', 'zzr_click', 'id', 'CASCADE');
        $this->addForeignKey('i2c_ip', 'zzr_ip_to_click', 'ip_id', 'zzr_ip', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('zzr_ip_to_click');
        echo "m170411_093049_zzr_ip_to_click cannot be reverted.\n";

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

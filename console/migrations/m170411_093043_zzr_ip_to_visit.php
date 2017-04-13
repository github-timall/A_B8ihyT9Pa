<?php

use yii\db\Migration;

class m170411_093043_zzr_ip_to_visit extends Migration
{
    public function up()
    {
        $this->createTable('zzr_ip_to_visit', [
            'visit_id' => $this->integer(),
            'ip_id' => $this->integer(),
        ]);
        $this->addPrimaryKey('i2v', 'zzr_ip_to_visit', ['visit_id', 'ip_id']);
        $this->addForeignKey('i2v_visit', 'zzr_ip_to_visit', 'visit_id', 'zzr_visit', 'id', 'CASCADE');
        $this->addForeignKey('i2v_ip', 'zzr_ip_to_visit', 'ip_id', 'zzr_ip', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('zzr_ip_to_visit');
        echo "m170411_093043_zzr_ip_to_visit cannot be reverted.\n";

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

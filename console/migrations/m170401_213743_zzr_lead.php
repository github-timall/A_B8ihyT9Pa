<?php

use yii\db\Migration;

class m170401_213743_zzr_lead extends Migration
{
    public function up()
    {
        $this->createTable('zzr_lead', [
            'id' => $this->primaryKey(),

            'affiliate_id' => $this->integer(),
            'visit_id' => $this->integer(),

            '_crm' => $this->smallInteger(),
            '_error' => $this->smallInteger(),
            '_cpa' => $this->smallInteger(),
            '_stream' => $this->smallInteger(),
            'status' => $this->smallInteger(),
            'status_partner' => $this->smallInteger(),

            'source' => $this->string(),
            'comment' => $this->string(),
            'payment' => $this->decimal(10, 2),
            'sum' => $this->decimal(10, 2),
            'time_to_call' => $this->dateTime(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_lead');
        echo "m170401_213743_zzr_lead cannot be reverted.\n";

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

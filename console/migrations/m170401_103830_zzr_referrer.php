<?php

use yii\db\Migration;

class m170401_103830_zzr_referrer extends Migration
{
    public function up()
    {
        $this->createTable('zzr_referrer', [
            'id' => $this->primaryKey(),

            'host' => $this->string(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_referrer');
        echo "m170401_103830_zzr_referrer cannot be reverted.\n";

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

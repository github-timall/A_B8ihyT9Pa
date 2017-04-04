<?php

use yii\db\Migration;

class m170401_102528_zzr_unique extends Migration
{
    public function up()
    {
        $this->createTable('zzr_unique', [
            'id' => $this->primaryKey(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_unique');
        echo "m170401_102528_zzr_unique cannot be reverted.\n";

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

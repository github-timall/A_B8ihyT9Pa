<?php

use yii\db\Migration;

class m170401_102752_zzr_device extends Migration
{
    public function up()
    {
        $this->createTable('zzr_device', [
            'id' => $this->primaryKey(),

            'is_mobile' => $this->boolean(),
            'is_tablet' => $this->boolean(),
            'is_bot' => $this->boolean(),
            'is_desktop' => $this->boolean(),
            'os' => $this->string(8),
            'os_version' => $this->smallInteger(),
            'client_type' => $this->string(32),
            'client_name' => $this->string(8),
            'client_version' => $this->smallInteger(),
            'brand' => $this->string(32),
            'model' => $this->string(32),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_device');
        echo "m170401_102752_zzr_device cannot be reverted.\n";

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

<?php

use yii\db\Migration;

class m170401_213754_zzr_client extends Migration
{
    public function up()
    {
        $this->createTable('zzr_client', [
            'id' => $this->primaryKey(),

            'name' => $this->string(),
            'phone' => $this->string(),
            'geo_code' => $this->string(),
            'email' => $this->string(),
            'country' => $this->string(),
            'city' => $this->string(),
            'age' => $this->string(),
            'gender' => $this->string(),
            'region' => $this->string(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_client');
        echo "m170401_213754_zzr_client cannot be reverted.\n";

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

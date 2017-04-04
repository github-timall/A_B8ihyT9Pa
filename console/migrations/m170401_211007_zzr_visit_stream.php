<?php

use yii\db\Migration;

class m170401_211007_zzr_visit_stream extends Migration
{
    public function up()
    {
        $this->createTable('zzr_visit_stream', [
            'id' => $this->primaryKey(),

            'visit_id' => $this->integer(),
            'stream_id' => $this->integer(),
            'pre_landing_id' => $this->integer(),
            'landing_id' => $this->integer(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_visit_stream');
        echo "m170401_211007_zzr_visit_stream cannot be reverted.\n";

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

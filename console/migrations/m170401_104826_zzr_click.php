<?php

use yii\db\Migration;

class m170401_104826_zzr_click extends Migration
{
    public function up()
    {
        $this->createTable('zzr_click', [
            'id' => $this->primaryKey(),

            'visit_id' => $this->integer(),

            'method' => $this->smallInteger(),
            'page_type' => $this->string(32),
            'page_id' => $this->integer(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('zzr_click');
        echo "m170401_104826_zzr_click cannot be reverted.\n";

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

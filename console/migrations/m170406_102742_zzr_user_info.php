<?php

use yii\db\Migration;

class m170406_102742_zzr_user_info extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('zzr_user_info', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'username' => $this->string(),
            'skype' => $this->string(),
            'language' => $this->string(16),
            'utm_source' => $this->string(),

            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('zzr_user_info');
        echo "m170406_102742_zzr_user_info cannot be reverted.\n";

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

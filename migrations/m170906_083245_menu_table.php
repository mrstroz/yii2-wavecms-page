<?php

use yii\db\Migration;

class m170906_083245_menu_table extends Migration
{
    public function safeUp()
    {

        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'parent_id' => $this->bigInteger(),
            'type' => $this->string(10),
            'publish' => $this->boolean(),
            'sort' => $this->bigInteger(),
            'languages' => $this->string(),
            'page_id' => $this->bigInteger()
        ]);

        $this->createTable('{{%menu_lang}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'menu_id' => $this->bigInteger(),
            'language' => $this->string(10),
            'title' => $this->string(),
            'page_url' => $this->string()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
        $this->dropTable('{{%menu_lang}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170906_083245_menu_table cannot be reverted.\n";

        return false;
    }
    */
}

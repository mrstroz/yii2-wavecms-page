<?php

use yii\db\Migration;

class m170921_073526_page_item_table extends Migration
{
    public function safeUp()
    {

        $this->createTable('{{%page_item}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'page_id' => $this->bigInteger(),
            'publish' => $this->boolean(),
            'sort' => $this->bigInteger(),
            'type' => $this->string(),
            'languages' => $this->string(),
            'image' => $this->string(),
            'link_page_id' => $this->bigInteger()
        ]);

        $this->createTable('{{%page_item_lang}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'page_item_id' => $this->bigInteger()->unsigned()->notNull(),
            'language' => $this->string(10),
            'title' => $this->string(),
            'text' => $this->text(),
            'link_page_url' => $this->string()
        ]);

        $this->createIndex('page_id', '{{%page_item}}', ['page_id']);
        $this->createIndex('page_item_id', '{{%page_item_lang}}', ['page_item_id']);

    }

    public function safeDown()
    {
        $this->dropTable('{{%page_item}}');
        $this->dropTable('{{%page_item_lang}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170921_073526_page_item_table cannot be reverted.\n";

        return false;
    }
    */
}

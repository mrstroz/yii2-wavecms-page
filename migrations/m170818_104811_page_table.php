<?php

use yii\db\Migration;

class m170818_104811_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%page}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->notNull(),
            'publish' => $this->boolean(),
            'type' => $this->string(),
            'languages' => $this->string(),
        ], $tableOptions);

        $this->createTable('{{%page_lang}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->notNull(),
            'page_id' => $this->bigInteger()->unsigned()->notNull(),
            'language' => $this->string(10),
            'title' => $this->string(),
            'link' => $this->string(),
            'text' => $this->text()
        ], $tableOptions);

        $this->createIndex('page_id', '{{%page_lang}}', ['page_id']);


    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%page}}');
        $this->dropTable('{{%page_lang}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180925_101749_grid_section
 */
class m180925_101749_grid_section extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('page_item', 'template', $this->string()->after('type'));
        $this->addColumn('page_item', 'image_mobile', $this->string()->after('image'));

        $this->addColumn('page_item_lang', 'link_title', $this->string()->after('text'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page_item','template');
        $this->dropColumn('page_item','image_mobile');
        $this->dropColumn('page_item_lang','link_title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180925_101749_grid_section cannot be reverted.\n";

        return false;
    }
    */
}

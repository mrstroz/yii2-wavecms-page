<?php

use yii\db\Migration;

/**
 * Class m190710_141317_link_rel_page_item
 */
class m190710_141317_link_rel_page_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('page_item', 'link_rel', $this->string()->after('image_mobile'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190710_141317_link_rel_page_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190710_141317_link_rel_page_item cannot be reverted.\n";

        return false;
    }
    */
}

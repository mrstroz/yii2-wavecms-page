<?php

use yii\db\Migration;

/**
 * Class m171124_100605_blank_field_for_menu
 */
class m171124_100605_blank_field_for_menu extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('menu', 'page_blank', $this->boolean()->after('page_id'));
        $this->addColumn('page_item', 'link_page_blank', $this->boolean()->after('link_page_id'));

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171124_100605_blank_field_for_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171124_100605_blank_field_for_menu cannot be reverted.\n";

        return false;
    }
    */
}

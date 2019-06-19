<?php

use yii\db\Migration;

/**
 * Class m190619_130413_menu_rel_column
 */
class m190619_130413_menu_rel_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('menu', 'rel', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190619_130413_menu_rel_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_130413_menu_rel_column cannot be reverted.\n";

        return false;
    }
    */
}

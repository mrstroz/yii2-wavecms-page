<?php

use yii\db\Migration;

/**
 * Class m171109_123349_page_updates
 */
class m171109_123349_page_updates extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->addColumn('{{%page}}', 'template', $this->string()->after('type'));
        $this->addColumn('{{%page}}', 'created_at', $this->integer());
        $this->addColumn('{{%page}}', 'updated_at', $this->integer());

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%page}}','template');
        $this->dropColumn('{{%page}}','created_at');
        $this->dropColumn('{{%page}}','updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171109_123349_page_updates cannot be reverted.\n";

        return false;
    }
    */
}

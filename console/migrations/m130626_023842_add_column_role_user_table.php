<?php

use yii\db\Migration;

/**
 * Class m130626_023842_add_column_role_user_table
 */
class m130626_023842_add_column_role_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->string(40)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230426_023842_add_column_role_user_table cannot be reverted.\n";

        return false;
    }
    */
}

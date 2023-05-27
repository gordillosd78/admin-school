<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%concepto}}`.
 */
class m230505_154107_add_periodo_column_to_concepto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%concepto}}', 'periodo', $this->integer()->after('nombre')->defaultValue(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%concepto}}', 'periodo');
    }
}

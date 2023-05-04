<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%detalle_cuota}}`.
 */
class m230503_143104_add_periodo_column_to_detalle_cuota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%detalle_cuota}}', 'periodo', $this->integer(2)->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%detalle_cuota}}', 'periodo');
    }
}

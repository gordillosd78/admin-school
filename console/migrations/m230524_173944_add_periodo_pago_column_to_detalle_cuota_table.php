<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%detalle_cuota}}`.
 */
class m230524_173944_add_periodo_pago_column_to_detalle_cuota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%detalle_cuota}}', 'periodo_pago', $this->integer()->after('concepto_id'));
        $this->addColumn('{{%detalle_cuota}}', 'vencimiento', $this->date()->after('periodo_pago'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%detalle_cuota}}', 'vencimiento');
        $this->dropColumn('{{%detalle_cuota}}', 'periodo_pago');
    }
}

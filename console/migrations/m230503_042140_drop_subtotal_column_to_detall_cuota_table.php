<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%subtotal_column_to_detall_cuota}}`.
 */
class m230503_042140_drop_subtotal_column_to_detall_cuota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%detalle_cuota}}', 'subtotal');
        $this->dropColumn('{{%detalle_cuota}}', 'descripcion');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%detalle_cuota}}', 'descripcion', $this->String(250));
        $this->addColumn('{{%detalle_cuota}}', 'subtotal', $this->double(12, 2));
    }
}

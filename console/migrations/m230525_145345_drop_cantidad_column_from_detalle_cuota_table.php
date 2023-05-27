<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%detalle_cuota}}`.
 */
class m230525_145345_drop_cantidad_column_from_detalle_cuota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%detalle_cuota}}', 'cantidad');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%detalle_cuota}}', 'cantidad', $this->integer());
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%alumno}}`.
 */
class m230429_230927_add_fecha_nacimiento_column_to_alumno_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%alumno}}', 'fecha_nacimiento', $this->date()->after('dni'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try {
            $this->dropColumn('{{%alumno}}', 'fecha_nacimiento');
        } catch (PDOException $e) {
            echo "Error: " . $e;
        }
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%concepto}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230429_060501_create_concepto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%concepto}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45)->unique(),
            'monto' => $this->float(),
            'observacion' => $this->string(250),
            'estado' => $this->integer(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-concepto-created_by}}',
            '{{%concepto}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-concepto-created_by}}',
            '{{%concepto}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-concepto-updated_by}}',
            '{{%concepto}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-concepto-updated_by}}',
            '{{%concepto}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        try {
            $this->insert('{{%concepto}}', [
                'id' => 1,
                'nombre' => 'NoDefinido',
                'observacion' => 'Para uso interno del sistema',
                'estado' => '0',
                'created_at' => date('Y-m-d'),
                'created_by' => '1',
            ]);
        } catch (\yii\db\Exception $ex) {
            echo " Problema para ejecutar migration -> " . $ex->getMessage();
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops default record
        $this->delete('{{%concepto}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-concepto-created_by}}',
            '{{%concepto}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-concepto-created_by}}',
            '{{%concepto}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-concepto-updated_by}}',
            '{{%concepto}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-concepto-updated_by}}',
            '{{%concepto}}'
        );

        $this->dropTable('{{%concepto}}');
    }
}

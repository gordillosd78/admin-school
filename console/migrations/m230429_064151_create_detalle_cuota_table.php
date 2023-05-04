<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%detalle_cuota}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cuota}}`
 * - `{{%concepto}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230429_064151_create_detalle_cuota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%detalle_cuota}}', [
            'id' => $this->primaryKey(),
            'subtotal' => $this->float(),
            'descripcion' => $this->string(45),
            'cantidad' => $this->integer(),
            'interes' => $this->float(),
            'cuota_id' => $this->integer()->notNull(),
            'concepto_id' => $this->integer()->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `cuota_id`
        $this->createIndex(
            '{{%idx-detalle_cuota-cuota_id}}',
            '{{%detalle_cuota}}',
            'cuota_id'
        );

        // add foreign key for table `{{%cuota}}`
        $this->addForeignKey(
            '{{%fk-detalle_cuota-cuota_id}}',
            '{{%detalle_cuota}}',
            'cuota_id',
            '{{%cuota}}',
            'id',
            'CASCADE'
        );

        // creates index for column `concepto_id`
        $this->createIndex(
            '{{%idx-detalle_cuota-concepto_id}}',
            '{{%detalle_cuota}}',
            'concepto_id'
        );

        // add foreign key for table `{{%concepto}}`
        $this->addForeignKey(
            '{{%fk-detalle_cuota-concepto_id}}',
            '{{%detalle_cuota}}',
            'concepto_id',
            '{{%concepto}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-detalle_cuota-created_by}}',
            '{{%detalle_cuota}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-detalle_cuota-created_by}}',
            '{{%detalle_cuota}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-detalle_cuota-updated_by}}',
            '{{%detalle_cuota}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-detalle_cuota-updated_by}}',
            '{{%detalle_cuota}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        try {
            $this->insert('{{%detalle_cuota}}', [
                'id' => 1,
                'cuota_id' => '1',
                'concepto_id' => '1',
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
        $this->delete('{{%detalle_cuota}}', ['id' => '1']);

        // drops foreign key for table `{{%cuota}}`
        $this->dropForeignKey(
            '{{%fk-detalle_cuota-cuota_id}}',
            '{{%detalle_cuota}}'
        );

        // drops index for column `cuota_id`
        $this->dropIndex(
            '{{%idx-detalle_cuota-cuota_id}}',
            '{{%detalle_cuota}}'
        );

        // drops foreign key for table `{{%concepto}}`
        $this->dropForeignKey(
            '{{%fk-detalle_cuota-concepto_id}}',
            '{{%detalle_cuota}}'
        );

        // drops index for column `concepto_id`
        $this->dropIndex(
            '{{%idx-detalle_cuota-concepto_id}}',
            '{{%detalle_cuota}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-detalle_cuota-created_by}}',
            '{{%detalle_cuota}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-detalle_cuota-created_by}}',
            '{{%detalle_cuota}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-detalle_cuota-updated_by}}',
            '{{%detalle_cuota}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-detalle_cuota-updated_by}}',
            '{{%detalle_cuota}}'
        );

        $this->dropTable('{{%detalle_cuota}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cuota}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%alumno}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230429_063140_create_cuota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cuota}}', [
            'id' => $this->primaryKey(),
            'fecha' => $this->date(),
            'vencimiento' => $this->date(),
            'total' => $this->float(),
            'alumno_id' => $this->integer()->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `alumno_id`
        $this->createIndex(
            '{{%idx-cuota-alumno_id}}',
            '{{%cuota}}',
            'alumno_id'
        );

        // add foreign key for table `{{%alumno}}`
        $this->addForeignKey(
            '{{%fk-cuota-alumno_id}}',
            '{{%cuota}}',
            'alumno_id',
            '{{%alumno}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-cuota-created_by}}',
            '{{%cuota}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-cuota-created_by}}',
            '{{%cuota}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-cuota-updated_by}}',
            '{{%cuota}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-cuota-updated_by}}',
            '{{%cuota}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        try {
            $this->insert('{{%cuota}}', [
                'id' => 1,
                'alumno_id' => '1',
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
        $this->delete('{{%cuota}}', ['id' => '1']);

        // drops foreign key for table `{{%alumno}}`
        $this->dropForeignKey(
            '{{%fk-cuota-alumno_id}}',
            '{{%cuota}}'
        );

        // drops index for column `alumno_id`
        $this->dropIndex(
            '{{%idx-cuota-alumno_id}}',
            '{{%cuota}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-cuota-created_by}}',
            '{{%cuota}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-cuota-created_by}}',
            '{{%cuota}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-cuota-updated_by}}',
            '{{%cuota}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-cuota-updated_by}}',
            '{{%cuota}}'
        );

        $this->dropTable('{{%cuota}}');
    }
}

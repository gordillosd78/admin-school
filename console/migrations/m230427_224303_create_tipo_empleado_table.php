<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tipo_empleado}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230427_224303_create_tipo_empleado_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tipo_empleado}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45)->notNull()->unique(),
            'observacion' => $this->string(250),
            'estado' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-tipo_empleado-created_by}}',
            '{{%tipo_empleado}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tipo_empleado-created_by}}',
            '{{%tipo_empleado}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'

        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-tipo_empleado-updated_by}}',
            '{{%tipo_empleado}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tipo_empleado-updated_by}}',
            '{{%tipo_empleado}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%tipo_empleado}}', [
                'id' => 1,
                'nombre' => 'NoDefinido',
                'observacion' => 'Para uso interno del sistema',
                'estado' => '0',
                'created_at' => date('Y-m-d'),
                'created_by' => '1',
                'updated_by' => '1'
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
        $this->delete('{{%tipo_empleado}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tipo_empleado-created_by}}',
            '{{%tipo_empleado}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-tipo_empleado-created_by}}',
            '{{%tipo_empleado}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tipo_empleado-updated_by}}',
            '{{%tipo_empleado}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-tipo_empleado-updated_by}}',
            '{{%tipo_empleado}}'
        );

        $this->dropTable('{{%tipo_empleado}}');
    }
}

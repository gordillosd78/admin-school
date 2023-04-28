<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%empleado}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tipo_empleado}}`
 * - `{{%user}}`
 */
class m230427_225841_create_empleado_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%empleado}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45)->notNull(),
            'apellido' => $this->string(45)->notNull(),
            'fecha_nacimiento' => $this->datetime(),
            'domicilio' => $this->string(50),
            'telefono' => $this->integer(12),
            'observacion' => $this->string(250),
            'estado' => $this->integer()->defaultValue(0),
            'tipo_empleado_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `tipo_empleado_id`
        $this->createIndex(
            '{{%idx-empleado-tipo_empleado_id}}',
            '{{%empleado}}',
            'tipo_empleado_id'
        );

        // add foreign key for table `{{%tipo_empleado}}`
        $this->addForeignKey(
            '{{%fk-empleado-tipo_empleado_id}}',
            '{{%empleado}}',
            'tipo_empleado_id',
            '{{%tipo_empleado}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-empleado-created_by}}',
            '{{%empleado}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-empleado-created_by}}',
            '{{%empleado}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-empleado-updated_by}}',
            '{{%empleado}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-empleado-updated_by}}',
            '{{%empleado}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%empleado}}', [
                'id' => 1,
                'nombre' => 'NoDefinido',
                'apellido' => 'NoDefinido',
                'observacion' => 'Para uso interno del sistema',
                'estado' => '0',
                'tipo_empleado_id' => 1,
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
        $this->delete('{{%empleado}}', ['id' => '1']);

        // drops foreign key for table `{{%tipo_empleado}}`
        $this->dropForeignKey(
            '{{%fk-empleado-tipo_empleado_id}}',
            '{{%empleado}}'
        );

        // drops index for column `tipo_empleado_id`
        $this->dropIndex(
            '{{%idx-empleado-tipo_empleado_id}}',
            '{{%empleado}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-empleado-created_by}}',
            '{{%empleado}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-empleado-created_by}}',
            '{{%empleado}}'
        );
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-empleado-updated_by}}',
            '{{%empleado}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-empleado-updated_by}}',
            '{{%empleado}}'
        );

        $this->dropTable('{{%empleado}}');
    }
}

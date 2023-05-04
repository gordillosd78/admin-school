<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carrera}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230429_052424_create_carrera_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carrera}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(60),
            'descripcion' => $this->string(250),
            'resolucion' => $this->string(45),
            'duracion' => $this->integer(),
            'estado' => $this->integer(),
            'observacion' => $this->string(250),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-carrera-created_by}}',
            '{{%carrera}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-carrera-created_by}}',
            '{{%carrera}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-carrera-updated_by}}',
            '{{%carrera}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-carrera-updated_by}}',
            '{{%carrera}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        try {
            $this->insert('{{%carrera}}', [
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
        $this->delete('{{%carrera}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-carrera-created_by}}',
            '{{%carrera}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-carrera-created_by}}',
            '{{%carrera}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-carrera-updated_by}}',
            '{{%carrera}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-carrera-updated_by}}',
            '{{%carrera}}'
        );

        $this->dropTable('{{%carrera}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%espacio}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tipo_espacio}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230428_000954_create_espacio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%espacio}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45)->notNull()->unique(),
            'descripcion' => $this->string(50),
            'capacidad' => $this->integer(),
            'tipo_espacio_id' => $this->integer()->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `tipo_espacio_id`
        $this->createIndex(
            '{{%idx-espacio-tipo_espacio_id}}',
            '{{%espacio}}',
            'tipo_espacio_id'
        );

        // add foreign key for table `{{%tipo_espacio}}`
        $this->addForeignKey(
            '{{%fk-espacio-tipo_espacio_id}}',
            '{{%espacio}}',
            'tipo_espacio_id',
            '{{%tipo_espacio}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-espacio-created_by}}',
            '{{%espacio}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-espacio-created_by}}',
            '{{%espacio}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-espacio-updated_by}}',
            '{{%espacio}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-espacio-updated_by}}',
            '{{%espacio}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%espacio}}', [
                'id' => 1,
                'nombre' => 'NoDefinido',
                'observacion' => 'Para uso interno del sistema',
                'estado' => '0',
                'tipo_espacio_id' => '1',
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
        $this->delete('{{%espacio}}', ['id' => '1']);

        // drops foreign key for table `{{%tipo_espacio}}`
        $this->dropForeignKey(
            '{{%fk-espacio-tipo_espacio_id}}',
            '{{%espacio}}'
        );

        // drops index for column `tipo_espacio_id`
        $this->dropIndex(
            '{{%idx-espacio-tipo_espacio_id}}',
            '{{%espacio}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-espacio-created_by}}',
            '{{%espacio}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-espacio-created_by}}',
            '{{%espacio}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-espacio-updated_by}}',
            '{{%espacio}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-espacio-updated_by}}',
            '{{%espacio}}'
        );

        $this->dropTable('{{%espacio}}');
    }
}

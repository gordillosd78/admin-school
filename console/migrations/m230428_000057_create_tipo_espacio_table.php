<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tipo_espacio}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230428_000057_create_tipo_espacio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tipo_espacio}}', [
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
            '{{%idx-tipo_espacio-created_by}}',
            '{{%tipo_espacio}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tipo_espacio-created_by}}',
            '{{%tipo_espacio}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-tipo_espacio-updated_by}}',
            '{{%tipo_espacio}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tipo_espacio-updated_by}}',
            '{{%tipo_espacio}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%tipo_espacio}}', [
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
        $this->delete('{{%tipo_espacio}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tipo_espacio-created_by}}',
            '{{%tipo_espacio}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-tipo_espacio-created_by}}',
            '{{%tipo_espacio}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tipo_espacio-updated_by}}',
            '{{%tipo_espacio}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-tipo_espacio-updated_by}}',
            '{{%tipo_espacio}}'
        );

        $this->dropTable('{{%tipo_espacio}}');
    }
}

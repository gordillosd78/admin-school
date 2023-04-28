<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%turno}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230428_001617_create_turno_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%turno}}', [
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
            '{{%idx-turno-created_by}}',
            '{{%turno}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-turno-created_by}}',
            '{{%turno}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-turno-updated_by}}',
            '{{%turno}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-turno-updated_by}}',
            '{{%turno}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%turno}}', [
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
        $this->delete('{{%turno}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-turno-created_by}}',
            '{{%turno}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-turno-created_by}}',
            '{{%turno}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-turno-updated_by}}',
            '{{%turno}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-turno-updated_by}}',
            '{{%turno}}'
        );

        $this->dropTable('{{%turno}}');
    }
}

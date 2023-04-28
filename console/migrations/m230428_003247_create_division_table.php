<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%division}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%curso}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230428_003247_create_division_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%division}}', [
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
            '{{%idx-division-created_by}}',
            '{{%division}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-division-created_by}}',
            '{{%division}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-division-updated_by}}',
            '{{%division}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-division-updated_by}}',
            '{{%division}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%division}}', [
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
        $this->delete('{{%division}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-division-created_by}}',
            '{{%division}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-division-created_by}}',
            '{{%division}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-division-updated_by}}',
            '{{%division}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-division-updated_by}}',
            '{{%division}}'
        );

        $this->dropTable('{{%division}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parentesco}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230428_161612_create_parentesco_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parentesco}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45)->unique()->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-parentesco-created_by}}',
            '{{%parentesco}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-parentesco-created_by}}',
            '{{%parentesco}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-parentesco-updated_by}}',
            '{{%parentesco}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-parentesco-updated_by}}',
            '{{%parentesco}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        try {
            $this->insert('{{%parentesco}}', [
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
        $this->delete('{{%parentesco}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-parentesco-created_by}}',
            '{{%parentesco}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-parentesco-created_by}}',
            '{{%parentesco}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-parentesco-updated_by}}',
            '{{%parentesco}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-parentesco-updated_by}}',
            '{{%parentesco}}'
        );

        $this->dropTable('{{%parentesco}}');
    }
}

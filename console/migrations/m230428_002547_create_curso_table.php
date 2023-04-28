<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%curso}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%espacio}}`
 * - `{{%turno}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230428_002547_create_curso_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%curso}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(45)->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer()->defaultValue(0),
            'espacio_id' => $this->integer()->notNull(),
            'turno_id' => $this->integer()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `espacio_id`
        $this->createIndex(
            '{{%idx-curso-espacio_id}}',
            '{{%curso}}',
            'espacio_id'
        );

        // add foreign key for table `{{%espacio}}`
        $this->addForeignKey(
            '{{%fk-curso-espacio_id}}',
            '{{%curso}}',
            'espacio_id',
            '{{%espacio}}',
            'id',
            'CASCADE'
        );

        // creates index for column `turno_id`
        $this->createIndex(
            '{{%idx-curso-turno_id}}',
            '{{%curso}}',
            'turno_id'
        );

        // add foreign key for table `{{%turno}}`
        $this->addForeignKey(
            '{{%fk-curso-turno_id}}',
            '{{%curso}}',
            'turno_id',
            '{{%turno}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-curso-created_by}}',
            '{{%curso}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-curso-created_by}}',
            '{{%curso}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-curso-updated_by}}',
            '{{%curso}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-curso-updated_by}}',
            '{{%curso}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%curso}}', [
                'id' => 1,
                'nombre' => 'NoDefinido',
                'observacion' => 'Para uso interno del sistema',
                'estado' => '0',
                'turno_id' => '1',
                'espacio_id' => '1',
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
        $this->delete('{{%curso}}', ['id' => '1']);

        // drops foreign key for table `{{%espacio}}`
        $this->dropForeignKey(
            '{{%fk-curso-espacio_id}}',
            '{{%curso}}'
        );

        // drops index for column `espacio_id`
        $this->dropIndex(
            '{{%idx-curso-espacio_id}}',
            '{{%curso}}'
        );

        // drops foreign key for table `{{%turno}}`
        $this->dropForeignKey(
            '{{%fk-curso-turno_id}}',
            '{{%curso}}'
        );

        // drops index for column `turno_id`
        $this->dropIndex(
            '{{%idx-curso-turno_id}}',
            '{{%curso}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-curso-created_by}}',
            '{{%curso}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-curso-created_by}}',
            '{{%curso}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-curso-updated_by}}',
            '{{%curso}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-curso-updated_by}}',
            '{{%curso}}'
        );

        $this->dropTable('{{%curso}}');
    }
}

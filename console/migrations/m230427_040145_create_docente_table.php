<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%docente}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230427_040145_create_docente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%docente}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(50)->notNull(),
            'apellido' => $this->string(25)->notNull(),
            'dni' => $this->integer(10)->notNull()->unique(),
            'fecha_nacimiento' => $this->datetime(),
            'domicilio' => $this->string(25),
            'email' => $this->string(50)->notNull(),
            'telefono' => $this->integer(25)->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer(2),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(2)->defaultValue(1),
            'updated_by' => $this->integer(2)->defaultValue(1),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-docente-created_by}}',
            '{{%docente}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-docente-created_by}}',
            '{{%docente}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-docente-updated_by}}',
            '{{%docente}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-docente-updated_by}}',
            '{{%docente}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        try {
            $this->insert('{{%docente}}', [

                'id' => 1,
                'nombre' => 'NoDefinido',
                'apellido' => 'NoDefinido',
                'dni' => '0',
                'email' => 'email@email.com',
                'telefono' => 0,
                'observacion' => 'Para uso interno del sistema',
                'estado' => '0',
                'created_at' => date('Y-m-d'),
                'created_by' => '1'
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
        $this->delete('{{%docente}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-docente-created_by}}',
            '{{%docente}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-docente-created_by}}',
            '{{%docente}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-docente-updated_by}}',
            '{{%docente}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-docente-updated_by}}',
            '{{%docente}}'
        );

        $this->dropTable('{{%docente}}');
    }
}

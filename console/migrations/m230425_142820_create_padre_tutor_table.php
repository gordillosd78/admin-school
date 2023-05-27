<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%padre_tutor}}`.
 */
class m230425_142820_create_padre_tutor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $this->createTable('{{%padre_tutor}}', [
                'id' => $this->primaryKey(),
                'nombre' => $this->string(35)->notNull(),
                'apellido' => $this->string(25)->notNull(),
                'dni' => $this->bigInteger(11)->unique()->notNull(),
                'domicilio' => $this->string(25),
                'localidad' => $this->string(25),
                'fecha_nacimiento' => $this->dateTime(),
                'observacion' => $this->string(250),
                'estado' => $this->integer()->defaultValue(0),
                'created_at' => $this->dateTime()->notNull(),
                'updated_at' => $this->dateTime(),
                'created_by' => $this->integer()->notNull(),
                'updated_by' => $this->integer(),
            ]);

            // creates index for column `created_by`
            $this->createIndex(
                '{{%idx-padre_tutor-created_by}}',
                '{{%padre_tutor}}',
                'created_by'
            );

            // add foreign key for table `{{%user}}`
            $this->addForeignKey(
                '{{%fk-padre_tutor-created_by}}',
                '{{%padre_tutor}}',
                'created_by',
                '{{%user}}',
                'id',
                'NO ACTION',
                'NO ACTION'
            );

            // creates index for column `updated_by`
            $this->createIndex(
                '{{%idx-padre_tutor-updated_by}}',
                '{{%padre_tutor}}',
                'updated_by'
            );

            // add foreign key for table `{{%user}}`
            $this->addForeignKey(
                '{{%fk-padre_tutor-updated_by}}',
                '{{%padre_tutor}}',
                'updated_by',
                '{{%user}}',
                'id',
                'NO ACTION',
                'NO ACTION'
            );

            $this->insert('{{%padre_tutor}}', [

                'id' => 1,
                'nombre' => 'NoDefinido',
                'apellido' => 'NoDefinido',
                'dni' => '0',
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
        $this->delete('{{%padre_tutor}}', ['id' => '1']);

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-padre_tutor-created_by}}',
            '{{%padre_tutor}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-padre_tutor-created_by}}',
            '{{%padre_tutor}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-padre_tutor-updated_by}}',
            '{{%padre_tutor}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-padre_tutor-updated_by}}',
            '{{%padre_tutor}}'
        );

        $this->dropTable('{{%padre_tutor}}');
    }
}

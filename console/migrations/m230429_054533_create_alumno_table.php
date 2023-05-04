<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%alumno}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%carrera}}`
 * - `{{%padre_tutor}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230429_054533_create_alumno_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%alumno}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(60),
            'apellido' => $this->string(50),
            'dni' => $this->integer(8)->unique(),
            'domicilio' => $this->string(45),
            'localidad' => $this->string(45),
            'email' => $this->string(40),
            'foto' => $this->string(50),
            'carrera_id' => $this->integer()->notNull(),
            'padre_tutor_id' => $this->integer()->notNull(),
            'observacion' => $this->string(250),
            'estado' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `carrera_id`
        $this->createIndex(
            '{{%idx-alumno-carrera_id}}',
            '{{%alumno}}',
            'carrera_id'
        );

        // add foreign key for table `{{%carrera}}`
        $this->addForeignKey(
            '{{%fk-alumno-carrera_id}}',
            '{{%alumno}}',
            'carrera_id',
            '{{%carrera}}',
            'id',
            'CASCADE'
        );

        // creates index for column `padre_tutor_id`
        $this->createIndex(
            '{{%idx-alumno-padre_tutor_id}}',
            '{{%alumno}}',
            'padre_tutor_id'
        );

        // add foreign key for table `{{%padre_tutor}}`
        $this->addForeignKey(
            '{{%fk-alumno-padre_tutor_id}}',
            '{{%alumno}}',
            'padre_tutor_id',
            '{{%padre_tutor}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-alumno-created_by}}',
            '{{%alumno}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-alumno-created_by}}',
            '{{%alumno}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-alumno-updated_by}}',
            '{{%alumno}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-alumno-updated_by}}',
            '{{%alumno}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'NO ACTION',
            'NO ACTION'
        );
        try {
            $this->insert('{{%alumno}}', [
                'id' => 1,
                'nombre' => 'NoDefinido',
                'carrera_id' => '1',
                'padre_tutor_id' => '1',
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
        $this->delete('{{%alumno}}', ['id' => '1']);

        // drops foreign key for table `{{%carrera}}`
        $this->dropForeignKey(
            '{{%fk-alumno-carrera_id}}',
            '{{%alumno}}'
        );

        // drops index for column `carrera_id`
        $this->dropIndex(
            '{{%idx-alumno-carrera_id}}',
            '{{%alumno}}'
        );

        // drops foreign key for table `{{%padre_tutor}}`
        $this->dropForeignKey(
            '{{%fk-alumno-padre_tutor_id}}',
            '{{%alumno}}'
        );

        // drops index for column `padre_tutor_id`
        $this->dropIndex(
            '{{%idx-alumno-padre_tutor_id}}',
            '{{%alumno}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-alumno-created_by}}',
            '{{%alumno}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-alumno-created_by}}',
            '{{%alumno}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-alumno-updated_by}}',
            '{{%alumno}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-alumno-updated_by}}',
            '{{%alumno}}'
        );

        $this->dropTable('{{%alumno}}');
    }
}

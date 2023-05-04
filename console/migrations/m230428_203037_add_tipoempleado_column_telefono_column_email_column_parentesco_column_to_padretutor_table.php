<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%padretutor}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tipo_empleado}}`
 * - `{{%parentesco}}`
 */
class m230428_203037_add_tipoempleado_column_telefono_column_email_column_parentesco_column_to_padretutor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%padre_tutor}}', 'tipo_empleado_id', $this->integer()->notNull()->after('fecha_nacimiento')->defaultValue(1));
        $this->addColumn('{{%padre_tutor}}', 'parentesco_id', $this->integer()->notNull()->defaultValue(1)->after('tipo_empleado_id'));
        $this->addColumn('{{%padre_tutor}}', 'telefono', $this->integer(10)->after('parentesco_id'));
        $this->addColumn('{{%padre_tutor}}', 'email', $this->string(30)->after('telefono'));

        // creates index for column `tipo_empleado_id`
        $this->createIndex(
            '{{%idx-padre_tutor-tipo_empleado_id}}',
            '{{%padre_tutor}}',
            'tipo_empleado_id'
        );

        // add foreign key for table `{{%tipo_empleado}}`
        $this->addForeignKey(
            '{{%fk-padre_tutor-tipo_empleado_id}}',
            '{{%padre_tutor}}',
            'tipo_empleado_id',
            '{{%tipo_empleado}}',
            'id',
            'CASCADE'
        );

        // creates index for column `parentesco_id`
        $this->createIndex(
            '{{%idx-padre_tutor-parentesco_id}}',
            '{{%padre_tutor}}',
            'parentesco_id'
        );

        // add foreign key for table `{{%parentesco}}`
        $this->addForeignKey(
            '{{%fk-padre_tutor-parentesco_id}}',
            '{{%padre_tutor}}',
            'parentesco_id',
            '{{%parentesco}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%tipo_empleado}}`
        $this->dropForeignKey(
            '{{%fk-padre_tutor-tipo_empleado_id}}',
            '{{%padre_tutor}}'
        );

        // drops index for column `tipo_empleado_id`
        $this->dropIndex(
            '{{%idx-padre_tutor-tipo_empleado_id}}',
            '{{%padre_tutor}}'
        );

        // drops foreign key for table `{{%parentesco}}`
        $this->dropForeignKey(
            '{{%fk-padre_tutor-parentesco_id}}',
            '{{%padre_tutor}}'
        );

        // drops index for column `parentesco_id`
        $this->dropIndex(
            '{{%idx-padre_tutor-parentesco_id}}',
            '{{%padre_tutor}}'
        );

        $this->dropColumn('{{%padre_tutor}}', 'tipo_empleado_id');
        $this->dropColumn('{{%padre_tutor}}', 'telefono');
        $this->dropColumn('{{%padre_tutor}}', 'email');
        $this->dropColumn('{{%padre_tutor}}', 'parentesco_id');
    }
}

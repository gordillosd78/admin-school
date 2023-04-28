<?php

use yii\db\Migration;

/**
 * Class m230428_112202_alter_curso_table
 */
class m230428_112202_alter_curso_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%curso}}', 'division_id', $this->integer(2)->notNull()->defaultValue(1)->after('turno_id'));

        // creates index for column `espacio_id`
        $this->createIndex(
            '{{%idx-curso-division_id}}',
            '{{%curso}}',
            'division_id'
        );

        // add foreign key for table `{{%espacio}}`
        $this->addForeignKey(
            '{{%fk-curso-division_id}}',
            '{{%curso}}',
            'division_id',
            '{{%division}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%division}}`
        $this->dropForeignKey(
            '{{%fk-curso-division_id}}',
            '{{%curso}}'
        );

        // drops index for column `division_id`
        $this->dropIndex(
            '{{%idx-curso-division_id}}',
            '{{%curso}}'
        );

        $this->dropColumn('{{%curso}}', 'division_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230428_112202_alter_curso_table cannot be reverted.\n";

        return false;
    }
    */
}

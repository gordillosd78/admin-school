<?php

use yii\db\Migration;

/**
 * Class m230426_001820_add_new_roles_sistemas_preceptor_docente
 */
class m230426_001820_add_new_roles_sistemas_preceptor_docente extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $admin->description = 'Role Admin';
        $auth->add($admin);
        $sistemas = $auth->createRole('sistemas');
        $sistemas->description = 'Role Sistemas';
        $auth->add($sistemas);
        $preceptor = $auth->createRole('preceptor');
        $preceptor->description = 'Role Preceptor';
        $auth->add($preceptor);
        $docente = $auth->createRole('docente');
        $docente->description = 'Role Docente';
        $auth->add($docente);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove('admin');
        $auth->remove('sistemas');
        $auth->remove('preceptor');
        $auth->remove('docente');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230426_001820_add_new_roles_sistemas_preceptor_docente cannot be reverted.\n";

        return false;
    }
    */
}

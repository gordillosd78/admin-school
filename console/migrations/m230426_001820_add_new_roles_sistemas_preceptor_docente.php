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
        $db = Yii::$app->db;
        $db->createCommand('
        
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "admin";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "docente";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "sistemas";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "preceptor";
        
        ')->execute();
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

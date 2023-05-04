<?php

use yii\db\Migration;

/**
 * Class m230428_224814_add_permisos_role_admin
 */
class m230428_224814_add_permisos_role_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');

        $inscripcion = $auth->createPermission('inscripcion');
        $inscripcion->description = 'user-check, Inscripcion';
        $auth->add($inscripcion);

        $auth->addChild($admin, $inscripcion);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230428_224814_add_permisos_role_admin reverted.\n";

        $db = Yii::$app->db;
        $db->createCommand('
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "inscripcion";

        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "inscripcion";
       ')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230428_224814_add_permisos_role_admin cannot be reverted.\n";

        return false;
    }
    */
}

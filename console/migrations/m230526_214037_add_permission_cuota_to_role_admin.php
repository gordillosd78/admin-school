<?php

use yii\db\Migration;

/**
 * Class m230526_214037_add_permission_cuota_to_role_admin
 */
class m230526_214037_add_permission_cuota_to_role_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');

        $cuota = $auth->createPermission('cuota');
        $cuota->description = 'money-check, Cuota';
        $auth->add($cuota);

        $auth->addChild($admin, $cuota);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230526_214037_add_permission_cuota_to_role_admin cannot be reverted.\n";

        $db = Yii::$app->db;
        $db->createCommand('
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "cuota";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "cuota";
       ')->execute();
    }
}

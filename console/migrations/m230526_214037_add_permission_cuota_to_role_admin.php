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
        $curso = $auth->createPermission('curso');
        $turno = $auth->createPermission('turno');
        $espacio = $auth->createPermission('espacio');
        $alumno = $auth->createPermission('alumno');
        $padreTutor = $auth->createPermission('padretutor');
        $tipoEmpleado = $auth->createPermission('tipoempleado');
        $tipoEspacio = $auth->createPermission('tipoespacio');

        $cuota->description = 'money-check, Cuota';
        $curso->description = 'chalkboard-teacher, Curso';
        $turno->description = 'clock, Turno';
        $espacio->description = 'door-open, Espacio';
        $alumno->description = 'user-graduate, Alumno';
        $padreTutor->description = 'user-secret, Padre/Tutor';
        $tipoEmpleado->description = 'user-tie, Tipo Empleado';
        $tipoEspacio->description = 'map-marked, Tipo Espacio';

        $auth->add($cuota);
        $auth->add($curso);
        $auth->add($turno);
        $auth->add($espacio);
        $auth->add($alumno);
        $auth->add($padreTutor);
        $auth->add($tipoEmpleado);
        $auth->add($tipoEspacio);

        $auth->addChild($admin, $cuota);
        $auth->addChild($admin, $curso);
        $auth->addChild($admin, $turno);
        $auth->addChild($admin, $espacio);
        $auth->addChild($admin, $alumno);
        $auth->addChild($admin, $padreTutor);
        $auth->addChild($admin, $tipoEmpleado);
        $auth->addChild($admin, $tipoEspacio);
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
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "curso";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "curso";
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "turno";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "turno";
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "espacio";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "espacio";
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "alumno";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "alumno";
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "padretutor";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "padretutor";
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "tipoempleado";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "tipoempleado";
        DELETE FROM `auth_item_child` WHERE `auth_item_child`.`parent` = "admin" AND `auth_item_child`.`child` = "tipoespacio";
        DELETE FROM `auth_item` WHERE `auth_item`.`name` = "tipoespacio";
       ')->execute();
    }
}

<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\User;
use yii\helpers\Console;
use Yii;

class AppController extends Controller
{
    public function actionAddUser($username, $email, $password, $role)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->role = $role;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->generateEmailVerificationToken();
        $user->generateAuthKey();
        if ($user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($user->role);
            if ($role) $auth->assign($role, $user->id);
            else Console::output("ERROR al intentar asignar un ROLE...");
            Console::output("Usuario Generado con exito");
        } else {
            Console::output("Error al generar el Usuario");
            var_dump($user->errors);
        }
    }
}

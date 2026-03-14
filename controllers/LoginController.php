<?php

namespace Controllers;

use Models\Users;
use MVC\Router;

class LoginController {
    
    public static function index(Router $router){
        $alerts = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new Users($_POST);
            $alerts = $user->validate();

            if(empty($alerts)) {

                $dbUser = Users::where("email",$user->email);

                if($dbUser && $dbUser->authenticate($user->password)) { 
                    $dbUser->getAccess();
                } 
                else { $user->setNewAlert("error", "Credenciales incorrectas"); }
            } 
            $alerts = $user->getAlerts();
        }

        $router->render("auth/login",[
            "title" => "Admin Login",
            "login" => true,
            "alerts" => $alerts,
            'routeName' => 'auth.login',
            'bodyClass' => 'is-auth'
        ], 'auth');
    }

    public static function logout(Router $router) {
        start_session();

        $_SESSION = [];

        header("Location: /");
        exit;
    }
}
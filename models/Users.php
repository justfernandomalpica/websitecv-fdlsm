<?php

namespace Models;

class Users extends ActiveRecord {
    public static $table = "users";
    public static $columns = ["id", "name", "email", "password", "created_at", "updated_at"];

    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->created_at = $args["created_at"] ?? "";
        $this->updated_at = $args["updated_at"] ?? "";
    }

    public function validate() {
        $alerts = [];

        if(!$this->email) { $this->setNewAlert("error", "El correo es necesario"); }
        if(!$this->password) { $this->setNewAlert("error", "La contraseña es necesaria"); }

        $alerts = $this->getAlerts();
        return $alerts;
    }

    public function hash_pass() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function authenticate($password) : bool {
        return password_verify($password, $this->password);
    }

    public function getAccess(){
        start_session();
        $followPath = $_SESSION["followPath"] ?? null;
        unset($_SESSION["followPath"]);

        $_SESSION["id"] = $this->id;
        $_SESSION["logged"] = true;

        if(isset($followPath)){
            header("Location: {$followPath}");
            exit;
        } else {
            header("Location: /admin");
            exit;
        }
         
    }
}
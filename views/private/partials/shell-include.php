<?php

if(str_contains($_SERVER["PATH_INFO"],"/create")) {

    $action = "Crear";
    include __DIR__ . "/../shells/create-update-shell.php";

}else if(str_contains($_SERVER["PATH_INFO"],"/edit")) {

    $action = "Editar";
    include __DIR__ . "/../shells/create-update-shell.php";
    
} else {
    include __DIR__ . "/../shells/module-shell.php";
}

if(str_contains($_SERVER["PATH_INFO"], "/delete")) {
    include __DIR__ . "/../../partials/modal.php";
}
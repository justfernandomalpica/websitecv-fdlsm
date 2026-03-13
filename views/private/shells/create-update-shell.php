<?php

$toAffect = "";

switch ($routeName) {
    case "admin.projects":
        $toAffect = "project";
    break;
    
    case "admin.career":
        $toAffect = "experience";
    break;
    
    case "admin.experiences":
        $toAffect = "area";
    break;

    default:
        header("Location: /admin");
        exit;
    break;
}

include __DIR__ . "/../partials/{$toAffect}-form.php";
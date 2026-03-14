<?php

function debug($var, $kill=true) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    if ($kill) { exit; }
}

// function isAuth() {
//     start_session();
    
//     $auth = $_SESSION["logged"];

//     if(!$auth) {
//         header("Location: /");
//         exit;
//     }
// }

function start_session() {
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}


function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function setFlash(string $type, string $message) : void {
    start_session();
    $_SESSION["flash"][] = [
        "type" => $type,
        "message" => $message
    ];
}

function getFlash() : array {
    start_session();
    $flash = $_SESSION["flash"] ?? [];
    unset($_SESSION["flash"]);
    return $flash;
}

function getFlashAsAlert() : array {
    start_session();
    $flash = $_SESSION["flash"] ?? [];
    $alerts = [];
    
    if(!empty($flash)){
        foreach($flash as $alert) {
            $alerts[$alert["type"]][] = $alert["message"];
        }
    }

    unset($_SESSION["flash"]);
    return $alerts;
}
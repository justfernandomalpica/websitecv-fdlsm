<?php

namespace MVC;

use Controllers\IndexController;

class Router {
    protected $urlGET = [];
    protected $urlPOST = [];
    
    public function setUrlGET($url, $fn){
        $this->urlGET[$url] = $fn;
    }
    public function setUrlPOST($url, $fn){
        $this->urlPOST[$url] = $fn;
    }

    public function validateURL() {
        start_session();
        $auth = $_SESSION["logged"] ?? false;

        $currUrl = strtok($_SERVER["REQUEST_URI"], "?") ?? "/";
        $method = $_SERVER["REQUEST_METHOD"];
        
        $fn = ($method === "GET") ? ($this->urlGET[$currUrl] ?? null) : ($this->urlPOST[$currUrl] ?? null);

        if(($currUrl === "/admin" || str_starts_with($currUrl, "/admin/")) && !$auth) {
            $_SESSION["followPath"] = $currUrl;
            unset($_SESSION["follorPath"]);
            header("Location: /login");
            exit;
        }

        if($fn) {
            call_user_func($fn, $this);
        } else {
            call_user_func([IndexController::class, "not_found"], $this);
        }
    }

    public function render($view, $data = [], $shell = "public"){ 
        
        foreach ($data as $key => $val){
            $$key = $val;
        }

        ob_start();
        include __DIR__ . "/views/{$view}.php";
        $content = ob_get_clean();

        $shellPath = __DIR__ . "/views/shells/{$shell}.php";
        $layoutPath = __DIR__ . "/views/layouts/base.php";

        $bodyClass = $bodyClass ?? '';
        $routeName = $routeName ?? '';
        $title     = "FDLSM | $title" ?? 'FDLSM';

        include $layoutPath;
    }
}
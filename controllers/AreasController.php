<?php

namespace Controllers;

use Models\Areas;
use MVC\Router;

class AreasController {
    public static function create(Router $router) {
        $alerts = [];
        $area = new Areas();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $area->sync($_POST);
            $area->validate();
            $alerts = $area->getAlerts();

            if(empty($alerts)) {
                $area->is_featured = isset($_POST["is_featured"]) ? 1 : 0;
                
                $area->save();
                setFlash("success", "El área se creó exitosamente!");
                header("Location: /admin/experiences");
                exit;
            }
        }

        $router->render("private/experiences", [
            "title" => "Areas de experiencia",
            'routeName' => 'admin.experiences',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            'area' => $area
        ], "admin");
    }

    public static function edit(Router $router) {
        $alerts = [];
        
        if(!isset($_GET["id"])) { header("Location: /admin/experiences"); exit; }

        $areaId = filter_var((int) $_GET["id"], FILTER_VALIDATE_INT);
        $area = Areas::find($areaId);

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $area->sync($_POST);
            $area->validate();
            $alerts = $area->getAlerts();

            if(empty($alerts)){
                $area->is_featured = isset($_POST["is_featured"]) ? 1 : 0;

                $area->save();
                setFlash("success", "El área se actualizó exitosamente!");
                header("Location: /admin/experiences");
                exit;
            }
        }
        
        $router->render("private/experiences", [
            "title" => "Areas de experiencia",
            'routeName' => 'admin.experiences',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            'area' => $area
        ], "admin");
    }

    public static function delete (Router $router) {
        $area = new Areas();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $areaId = filter_var( (int) $_POST["deleteId"], FILTER_VALIDATE_INT);
            $area = Areas::find($areaId);

            $area->delete();
            setFlash("success", "Area eliminada exitosamente");
            header("Location: /admin/experiences");
            exit;
        }

        $areaId = filter_var($_GET["id"], FILTER_VALIDATE_INT);
        if(Areas::find($areaId) !== null) {
            $args = Areas::find($areaId);
            $area->sync($args);
            $area->id = $areaId;       
        } else {
            setFlash("error", "El área con id {$areaId} no existe");
            header("Location: /admin/experiences");
            exit;
        }

        $router->render("private/experiences", [
            "title" => "Areas de experiencia",
            'routeName' => 'admin.experiences',
            'bodyClass' => 'is-admin',
            'toAffect' => "experiences",
            'deleteId' => $areaId
        ], "admin");
    }
}
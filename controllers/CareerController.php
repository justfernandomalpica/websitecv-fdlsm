<?php

namespace Controllers;

use Models\Experiences;
use MVC\Router;

class CareerController {

    public static function create(Router $router) {
        $alerts = [];
        $experience = new Experiences();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $experience->sync($_POST);
            $alerts = $experience->validate();
            
            if(empty($alerts)) {
                if(empty($experience->end_date)) $experience->end_date = null; 
                $experience->is_featured = isset($_POST["is_featured"]) ? 1 : 0;

                $experience->save();
                setFlash("success", "Experiencia crada extosamente!");
                header("Location: /admin/career");
                exit;
            }
        }

        $router->render("private/career", [
            "title" => "Curriculum",
            'routeName' => 'admin.career',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            "experience" => $experience
        ], "admin");
    }

    public static function edit(Router $router) {
        $alerts = [];
        $expId = filter_var((int) $_GET["id"], FILTER_VALIDATE_INT);

        if(!isset($_GET["id"])) { header("Location: /admin/career"); exit; }

        $experience = Experiences::find($expId);

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $experience->sync($_POST);
            $experience->validate();
            $alerts = $experience->getAlerts();
            
            if(empty($alerts)) {

                if(empty($experience->end_date)) $experience->end_date = null; 
                $experience->is_featured = isset($_POST["is_featured"]) ? 1 : 0;

                $experience->save();
                setFlash("success", "Experiencia actualizada extosamente!");
                header("Location: /admin/career");
                exit;

            }

        }

        $router->render("private/career", [
            "title" => "Curriculum",
            'routeName' => 'admin.career',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            "experience" => $experience
        ], "admin");
    }

    public static function delete (Router $router) {
        $experience = new Experiences();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $experienceId = filter_var( (int) $_POST["deleteId"], FILTER_VALIDATE_INT);
            $experience = Experiences::find($experienceId);

            $experience->delete();
            setFlash("success", "Experiencia eliminada exitosamente");
            header("Location: /admin/career");
            exit;
        }

        $experienceId = filter_var( (int) $_GET["id"], FILTER_VALIDATE_INT);
        if(Experiences::find($experienceId) !== null) {
            $args = Experiences::find($experienceId);
            $experience->sync($args);
            $experience->id = $experienceId;       
        } else {
            setFlash("error", "La experiencia con id {$experienceId} no existe");
            header("Location: /admin/career");
            exit;
        }

        $router->render("private/career", [
            "title" => "Curriculum",
            'routeName' => 'admin.career',
            'bodyClass' => 'is-admin',
            'toAffect' => "career",
            'deleteId' => $experienceId
        ], "admin");
    }
}
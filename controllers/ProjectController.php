<?php

namespace Controllers;

use Error;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
use Models\Images;
use Models\Projects;
use MVC\Router;

class ProjectController {
    public static function create(Router $router) {
        $alerts = [];
        $project = new Projects();

        if($_SERVER["REQUEST_METHOD"] === "POST") {

            $project->sync($_POST);
            $project->is_featured = isset($_POST["is_featured"]) ? 1 : 0;
            $project->validate();

            
            $alerts = $project->getAlerts();

            if(empty($alerts)) {
                $project->save();
                setFlash("success", "Proyecto creado exitosamente!");
                header("Location: /admin/projects");
                exit;
            }
        }

        $alerts = $project->getAlerts();

        $router->render("private/projects", [
            "title" => "Proyectos",
            'routeName' => 'admin.projects',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            'project' => $project
        ], "admin");
    }

    public static function update(Router $router) {
        $projId = filter_var($_GET["id"],FILTER_VALIDATE_INT);
        $project = Projects::find($projId);
        $images = Images::where("projectId", $projId, false);
        $alerts = [];

        if(!$project){
            setFlash("error", "El proyecto con id {$projId} no existe");
            header("Location: /admin/projects");
            exit;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $project->sync($_POST);
            $project->id = $projId;
            $project->is_featured = isset($_POST["is_featured"]) ? 1 : 0;
            
            if(empty($_FILES["long_description"]["tmp_name"])) $project->setNewAlert("error", "El archivo de descripcion es obligatorio");
            $alerts = $project->validate();
            
            if(empty($alerts)) {
                
                self::saveMPK($project,$_FILES["long_description"]);

                if(!empty($_FILES["thumbnail"]["tmp_name"])) {
                    ImagesController::createSingleImage($_FILES["thumbnail"], $project->id, "thumbnail");
                }
                if(!empty($_FILES["galery"]["tmp_name"][0])) {
                    ImagesController::createMultiImages($_FILES["galery"], $project->id, "galery");
                }
                $project->save();

                setFlash("success", "Cambios guardados exitosamente!");
                header("Location: /admin/projects");
                exit;
            }
        }
    
        $router->render("private/projects", [
            "title" => "Proyectos",
            'routeName' => 'admin.projects',
            'bodyClass' => 'is-admin',
            'project' => $project,
            'galery' => $images,
            'alerts' => $alerts
        ], "admin");
    }

    public static function delete(Router $router) {
        $project = new Projects();


        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $projId = filter_var($_POST["deleteId"], FILTER_VALIDATE_INT);
            $project = Projects::find($projId);

            $project->delete();
            setFlash("success", "Proyecto eliminado exitosamente");
            header("Location: /admin/projects");
            exit;
        }

        $projId = filter_var($_GET["id"], FILTER_VALIDATE_INT);
        if(Projects::find($projId) !== null) {
            $args = Projects::find($projId);
            $project->sync($args);
            $project->id = $projId;       
        } else {
            setFlash("error", "El proyecto con id {$projId} no existe");
            header("Location: /admin/projects");
            exit;
        }

        $router->render("private/projects", [
            "title" => "Proyectos",
            'routeName' => 'admin.projects',
            'bodyClass' => 'is-admin',
            'toAffect' => "projects",
            'deleteId' => $projId
        ], "admin");
    }

    private static function saveMPK(Projects $project, array $descriptionFile) {
        $project->long_description = $descriptionFile["name"];
        $destDir = __DIR__ . "/../src/doc/descriptions/" . $descriptionFile["name"];
        if(!move_uploaded_file($descriptionFile["tmp_name"], $destDir)) {
            throw new Error("EL archivo no se pudo mover a la carpte de descripciones");
        }
    }
}
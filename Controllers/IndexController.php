<?php

namespace Controllers;

use Models\Areas;
use Models\Projects;
use Models\Experiences;
use Models\Images;
use MVC\Router;

class IndexController {
    public static function index(Router $router){
        $projets = Projects::all();
        $areas = Areas::all();
        $experiences = Experiences::all();

        $router->render("public/index", [
            "title" => "Curriculum",
            'routeName' => 'home',
            'bodyClass' => 'is-public',
            'projects' => $projets,
            'areas' => $areas,
            'experiences' => $experiences
        ]);
    }

    public static function projects(Router $router) {
        $projets = Projects::all();

        $router->render("public/projects", [
            "title" => "Portafolio",
            'routeName' => 'projects',
            'bodyClass' => 'is-public',
            'projects' => $projets
        ]);
    }

    public static function project(Router $router) {
        $projectId = filter_var((int) $_GET["id"], FILTER_VALIDATE_INT);
        $project = Projects::find($projectId);

        if(!$project) {
            $_GET = [];
            header("Location: /projects");
            exit;
        }

        $projectImages = Images::where("projectId", $projectId, false);

        if(!empty($projectImages) ) {
            if(is_array($projectImages))
            foreach ($projectImages as $image) {
                if(isset($image->role) && $image->role === "thumbnail") {
                    $thumbnail = $image;
                } else if($image->role !== "thumbnail") {
                    $galery[] = $image;
                }
            } else if ($projectImages->role === "thumbnail") {
                $thumbnail = $projectImages;
            }
        } 

        $router->render("public/showcase/project", [
            "title" => "$project->name",
            'routeName' => 'project',
            'bodyClass' => 'is-public',
            'project' => $project,
            "thumbnail" => $thumbnail ?? null,
            "galery" => $galery ?? []
        ]);
    }
    
    public static function contact(Router $router) {
        $router->render("public/contact", [
            "title" => "Contacto",
            'routeName' => 'contact',
            'bodyClass' => 'is-public'
        ]);
    }

    public static function experience(Router $router) {
        $router->render("public/experience", [
            "title" => "Carrera",
            'routeName' => 'experience',
            'bodyClass' => 'is-public'
        ]);
    }

    public static function not_found(Router $router) {
        http_response_code(404);
        $router->render("public/404",[
            "title" => "Página no encontrada",
            "routeName" => "404",
            "bodyClass" => "not-found"
        ], "not-found");
    }
    
}
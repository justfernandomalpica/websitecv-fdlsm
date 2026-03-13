<?php

namespace Controllers;

use Models\Areas;
use Models\Experiences;
use Models\Projects;
use Models\Users;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        $router->render("private/index", [
            "title" => "Dashboard",
            'routeName' => 'admin.dashboard',
            'bodyClass' => 'is-admin'
        ], "admin");
    }

    public static function projects(Router $router) {
        $alerts = getFlashAsAlert();
        $projects =  Projects::all();

        $router->render("private/projects", [
            "title" => "Proyectos",
            'routeName' => 'admin.projects',
            'bodyClass' => 'is-admin',
            "alerts" => $alerts,
            "content" => $projects
        ], "admin");
    }

    public static function career(Router $router) {
        $alerts = getFlashAsAlert();
        $experiences = Experiences::all();

        $router->render("private/career", [
            "title" => "Curriculum",
            'routeName' => 'admin.career',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            "experiences" => $experiences
        ], "admin");
    }

    public static function experiences(Router $router) {
        $alerts = getFlashAsAlert();
        $areas = Areas::all();

        $router->render("private/experiences", [
            "title" => "Areas de experiencia",
            'routeName' => 'admin.experiences',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            'areas' => $areas
        ], "admin");
    }

    public static function relationships(Router $router) {
        $alerts = getFlashAsAlert();
        $relationships = Areas::all();

        $router->render("private/relationships", [
            "title" => "Relaciones",
            'routeName' => 'admin.relationships',
            'bodyClass' => 'is-admin',
            'alerts' => $alerts,
            'areas' => $relationships
        ], "admin");
    }
}
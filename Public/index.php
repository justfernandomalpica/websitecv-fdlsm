<?php

use Controllers\AdminController;
use Controllers\AreasController;
use Controllers\CareerController;
use Controllers\CreateController;
use Controllers\DeleteController;
use Controllers\ExperiencesController;
use Controllers\ImagesController;
use Controllers\IndexController;
use Controllers\LoginController;
use Controllers\ProjectController;
use Controllers\UpdateController;
use Models\Users;
use MVC\Router;

include __DIR__ . "/../Includes/app.php";

$router = new Router;

// Login
$router->setUrlGET("/login", [LoginController::class, "index"]);
$router->setUrlPOST("/login", [LoginController::class, "index"]);
$router->setUrlGET("/logout", [LoginController::class, "logout"]);

// Public frontend
    // Index
    $router->setUrlGET("/",[IndexController::class, "index"]);
    // Projects
    $router->setUrlGET("/projects", [IndexController::class, "projects"]);
    $router->setUrlGET("/project", [IndexController::class, "project"]);
    // Experience
    // $router->setUrlGET("/experience", [IndexController::class, "experience"]);
    // Contact 
    // $router->setUrlGET("/contact", [IndexController::class, "contact"]);

// Private frontend
    // Admin Index (Projects & Experience)
    $router->setUrlGET("/admin", [AdminController::class, "index"]);
    $router->setUrlGET("/admin/", [AdminController::class, "index"]);
    // Proyectos
    $router->setUrlGET("/admin/projects", [AdminController::class, "projects"]);
    $router->setUrlGET("/admin/projects/create", [ProjectController::class, "create"]);
    $router->setUrlPOST("/admin/projects/create", [ProjectController::class, "create"]);
    $router->setUrlGET("/admin/projects/edit", [ProjectController::class, "update"]);
    $router->setUrlPOST("/admin/projects/edit", [ProjectController::class, "update"]);
    $router->setUrlGET("/admin/projects/delete", [ProjectController::class, "delete"]);
    $router->setUrlPOST("/admin/projects/delete", [ProjectController::class, "delete"]);
    $router->setUrlGET("/admin/image/delete", [ImagesController::class, "deleteImageEntity"]);
    
    // Curriculum
    $router->setUrlGET("/admin/career", [AdminController::class, "career"]);
    $router->setUrlGET("/admin/career/create", [CareerController::class, "create"]);
    $router->setUrlPOST("/admin/career/create", [CareerController::class, "create"]);
    $router->setUrlGET("/admin/career/edit", [CareerController::class, "edit"]);
    $router->setUrlPOST("/admin/career/edit", [CareerController::class, "edit"]);
    $router->setUrlGET("/admin/career/delete", [CareerController::class, "delete"]);
    $router->setUrlPOST("/admin/career/delete", [CareerController::class, "delete"]);
    
    // Areas de expericia
    $router->setUrlGET("/admin/experiences", [AdminController::class, "experiences"]);
    $router->setUrlGET("/admin/experiences/create", [AreasController::class, "create"]);
    $router->setUrlPOST("/admin/experiences/create", [AreasController::class, "create"]);
    $router->setUrlGET("/admin/experiences/edit", [AreasController::class, "edit"]);
    $router->setUrlPOST("/admin/experiences/edit", [AreasController::class, "edit"]);
    $router->setUrlGET("/admin/experiences/delete", [AreasController::class, "delete"]);
    $router->setUrlPOST("/admin/experiences/delete", [AreasController::class, "delete"]);
    
    // Relaciones entre objetos
    $router->setUrlGET("/admin/relationships", [AdminController::class, "relationships"]);
    $router->setUrlGET("/admin/relationships/create", [ProjectController::class, "create"]);
    $router->setUrlPOST("/admin/relationships/create", [ProjectController::class, "create"]);
    $router->setUrlGET("/admin/relationships/edit", [ProjectController::class, "update"]);
    $router->setUrlPOST("/admin/relationships/edit", [ProjectController::class, "update"]);
    $router->setUrlGET("/admin/relationships/delete", [ProjectController::class, "delete"]);
    $router->setUrlPOST("/admin/relationships/delete", [ProjectController::class, "delete"]);

// Validar URLs  
$router->validateURL();





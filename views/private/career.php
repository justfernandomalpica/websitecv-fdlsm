<?php

$title = "Curriculum";
$description = "Agregar o actualizar experiencias laborales o educativas";
$objects = "experiencias";
$item = "experiencia";
$createUrl = "/admin/career/create";
$updateUrl = "/admin/career/edit";
$deleteUrl = "/admin/career/delete";
$content = $experiences ?? null;

include __DIR__ . "/partials/shell-include.php";

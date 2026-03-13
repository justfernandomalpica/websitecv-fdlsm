<?php

$title = "Areas de conocimiento";
$description = "Agregar o actualizar areas de conocimiento, interés o destreza";
$objects = "áreas";
$item = "área";
$createUrl = "/admin/experiences/create";
$updateUrl = "/admin/experiences/edit";
$deleteUrl = "/admin/experiences/delete";
$content = $areas ?? null;

include __DIR__ . "/partials/shell-include.php";
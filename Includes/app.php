<?php

use Models\ActiveRecord;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require __DIR__ . "/functions.php";
require __DIR__ . "/Config/database.php";

ActiveRecord::setDB($db);

date_default_timezone_set("America/Mexico_City");
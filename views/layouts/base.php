<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Curriculum Vitae en forma de sitio web. Enlista los proyectos, carrera profesional, areas de experiencia e interes. Cuenta con un area privada de administración que permite agregar entradas de curriculum, de experiencia y de portafolio.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="shortcut icon" href="/build/ico/animal.png" type="image/png">

    <title><?= htmlspecialchars($title) ?></title>
</head>
<body class="<?= htmlspecialchars($bodyClass); ?>">
    
    <?php include $shellPath; ?>

    <?php include __DIR__ . "/../partials/footer.php" ?>

    <?php if(!empty($_SESSION["logged"]) && $bodyClass !== "is-admin") {
        include __DIR__ . "/../partials/devbar.php";
    } ?>

    <?php if(isset($alerts)) {
        include __DIR__ . "/../partials/alerts.php";
    } ?>
        

    <script src="/build/js/bundle.min.js"></script>
</body>
</html>
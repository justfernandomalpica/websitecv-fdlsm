<?php 
$isHome = ($routeName === "home");
include __DIR__ . "/../partials/public/" . ($isHome ? 'header-home.php' : 'header-inner.php');
?>

<main class="public-main">
    <?= $content; ?>
</main>
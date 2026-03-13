<h1 class="title"><?= $title ?></h1>
<p class="description"><?= $description ?></p>

<div class="elements-container">
    <a class="create-button" href="<?= $createUrl ?>">Crear <?= $item ?></a>

    <?php if(!empty($content)) : include __DIR__ . "/../../partials/private/table.php" ?>
    <?php else :?>
        <p class="empty-message">No hay <?= $objects ?> que mostrar </p>
    <?php endif; ?>
</div>
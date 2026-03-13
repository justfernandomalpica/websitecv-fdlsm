<div class="project__container">
    <div class="project__header">
        <h1><?= $project->name ?? "Titulo proyecto"?></h1>
        <?php if(isset($thumbnail)) : ?>
            <picture>
                <source srcset="/build/img/projects/<?= $thumbnail->name ?>.webp" type="image/webp">
                <img loading="lazy" class="project__thumbnail" loading="lazy" src="/build/img/projects/<?= $thumbnail->name ?>.jpeg" alt="image/jpeg">
            </picture>
        <?php else : ?>
            <p class="image__placeholder">No hay nada que mostrar</p>
        <?php endif; ?>
        <p><?= $project->short_description ?? "Eslogan" ?></p>
    </div>

    <h2 class="project__description" >Descripción</h2>
    <div class="rich-text">
        <?php 
            $mpkPath = __DIR__ . '/../../../src/doc/descriptions/' . $project->long_description;
            $mpk = file_get_contents($mpkPath);
            echo $mpk;
        ?>
    </div>

    <div class="project__galery">
        <h2>Galería</h2>
        <?php if(!empty($galery)) : ?>
            <div class="galery__container">
                <?php foreach($galery as $image) : ?>
                    <picture>
                        <source srcset="/build/img/projects/<?= $image->name ?>.webp" type="image/webp">
                        <img loading="lazy" class="galery__image" loading="lazy" src="/build/img/projects/<?= $image->name ?>.jpeg" alt="image/jpeg">
                    </picture>
                <?php endforeach; ?>
            </div>
            <?php include_once __DIR__ . "/galery-modal.php" ?>
        <?php else : ?>
            <p class="image__placeholder">No hay nada que mostrar</p>
        <?php endif; ?>
    </div>
</div>
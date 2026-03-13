<h1>Nuevo proyecto</h1>

<form class="create-form" action="" method="post" enctype="multipart/form-data">
    <fieldset class="create-form-container project">
        <input 
            type="text"
            id="project-name"
            class="create-form-input"
            placeholder="Nombre del proyecto"
            name="name"
            value="<?= s($project->name) ?>"

        >
        <input 
            type="text"
            id="project-short_description"
            class="create-form-input"
            name="short_description"
            placeholder="Descripcion corta"
            value="<?= s($project->short_description) ?>"
        >
        <div>
            <label for="thumbanil">Agrega un thumbanil</label>
            <input type="file" id="thumbanil" name="thumbnail" accept="image/jpeg, image/png">
        </div>
        <div>
            <label for="galery">Agrega imagenes al proyecto</label>
            <input type="file" id="galery" name="galery[]" accept="image/jpeg, image/png" multiple>
        </div>
        <div>
            <label for="long_description">Sube archivo MPK de la descripcion</label>
            <input type="file" id="long_description" name="long_description" accept=".mpk" multiple>
        </div>
        
        <div>
            <input
                type="checkbox"
                id="project-is_featured"
                class="create-form-checkbox"
                name="is_featured"
                <?= ($project->is_featured === 1) ? "checked" : "" ?>
            >
            <label for="is_featured">
                Aparece en la pagina principal
            </label>
        </div>
    </fieldset>
    <div class="project__galery">
        <h2>Galería</h2>
        <?php if(!empty($galery) && is_array($galery)) : ?>
            <div class="galery__container">
                <?php foreach($galery as $image) : ?>
                    <a href="/admin/image/delete?id=<?= $image->id ?>&projId=<?= $project->id ?>">
                        <picture>
                            <source srcset="/build/img/projects/<?= $image->name ?>.webp" type="image/webp">
                            <img class="galery__image" loading="lazy" src="/build/img/projects/<?= $image->name ?>.jpeg" alt="image/jpeg">
                        </picture>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="image__placeholder">No hay nada que mostrar</p>
        <?php endif; ?>
    </div>
    <input
        type="submit"
        value="<?= $action ?> "
        class="create-form-submit"
    >
</form>
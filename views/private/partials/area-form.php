<h1>Nueva area de conocimiento</h1>

<form class="create-form" action="" method="post">
    <fieldset class="create-form-container area">
        <input 
            type="text"
            id="area-name"
            class="create-form-input"
            placeholder="Nombre del area"
            name="name"
            value="<?= $area->name ?>"
        >
        <input 
            type="text"
            id="area-short_description"
            class="create-form-input"
            name="short_description"
            placeholder="Descripcion corta"
            value="<?= $area->short_description ?>"
        >
        <textarea
            id="area-long_description"
            class="create-form-textarea"
            name="long_description"
            placeholder="Descripcion completa"
        ><?= $area->long_description ?></textarea>

        <div>
            <input
                type="checkbox"
                id="area-is_featured"
                class="create-form-checkbox"
                name="is_featured"
                <?= ($area->is_featured === 1) ? "checked" : "" ?>
            >
            <label for="is_featured">
                Aparece en la pagina principal
            </label>
        </div>
    </fieldset>
    <input
        type="submit"
        value="<?= $action ?> "
        class="create-form-submit"
    >
</form>
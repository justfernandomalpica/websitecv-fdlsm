<h1>Agregar experiencia</h1>
<p>Fecha de finalización vacía si la experiencia es actual.</p>

<form class="create-form" action="" method="POST">
    <fieldset class="create-form-container experience">
        <input 
            type="text"
            id="experience-name"
            class="create-form-input"
            placeholder="Nombre de la experiencia"
            name="name"
            value="<?= $experience->name ?>"
        >
        <input 
            type="text"
            id="experience-short_description"
            class="create-form-input"
            name="short_description"
            placeholder="Descripcion corta"
            value="<?= $experience->short_description ?>"
        >
        <div class="experience-type-container">
            <label for="type">Tipo de experiencia</label>
            <select name="type" id="type">
                <option <?= (!$experience->type) ? "selected" : "" ?> value="" disabled>- - Tipo - -</option>
                <option <?= ($experience->type === "work") ? "selected" : "" ?> value="work" >Laboral</option>
                <option <?= ($experience->type === "educ") ? "selected" : "" ?> value="educ">Académica</option>
            </select>
        </div>

        <div>
            <label for="start_date">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" value="<?= $experience->start_date ?>">
        </div>
        <div>
            <label for="end_date">Fecha de finalización</label>
            <input type="date" name="end_date" id="end_date" value="<?= $experience->end_date ?>">
        </div>

        <textarea
            id="experience-long_description"
            class="create-form-textarea"
            name="long_description"
            placeholder="Descripcion completa"
        ><?= $experience->long_description ?></textarea>
        <div>
            <input
                type="checkbox"
                id="experience-is_featured"
                class="create-form-checkbox"
                name="is_featured"
                <?= ($experience->is_featured === 1) ? "checked" : "" ?>
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
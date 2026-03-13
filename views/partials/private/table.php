<?php use Models\Images; ?>
<table class="table">
    <thead class="table-header">
        <tr>
            <th class="table-header-cell">Proyecto</th>
            <th class="table-header-cell">Imagen</th>
            <th class="table-header-cell">Descripción</th>
            <th class="table-header-cell">Acciones</th>
        </tr>
    </thead>
    <tbody class="table-body">
        <?php foreach ($content as $object) : ?>
            <tr class="table-body-row">
                <td class="table-body-cell"><?= s($object->name) ?></td>
                <td class="table-body-cell">
                    <?php if($objects === "proyectos") : $image = Images::where("projectId",$object->id); ?>
                        <picture>
                            <source srcset="/build/img/projects/<?= $image->name ?>.webp" type="image/webp">
                            <img class="galery__image" loading="lazy" src="/build/img/projects/<?= $image->name ?>.jpeg" alt="image/jpeg">
                        </picture>
                    <?php else : ?>
                        <p>*Foto*</p>
                    <?php endif; ?>
                </td>
                <td class="table-body-cell"><?= s($object->short_description) ?></td>
                <td class="table-body-cell buttons">
                    <a href="<?= $updateUrl . "?id=" . $object->id ?>" class="table-action-button edit">Editar</a>
                    <a href="<?= $deleteUrl . "?id=" . $object->id ?>" class="table-action-button delete">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
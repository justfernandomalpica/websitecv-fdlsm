<div id="modal" class="modal">
    <div id="modal-container" class="modal-container">
        <div id="modal-card" class="modal-card">
            <h2 id="modal-title" class="modal-title">¿Estas seguro?</h2>
            <p id="modal-text" class="modal-text">Esta acción borrará el elemento</p>
            <div class="modal-buttons">
                <form action="/admin/<?= $toAffect ?>/delete" method="POST">
                    <input type="hidden" name="deleteId" value="<?= $_GET["id"] ?>">
                    <input
                        type="submit"
                        id="modal-button-accept"
                        class="modal-button accept"
                        value="Aceptar">
                </form>
                <a href="/admin/<?= $toAffect ?>" id="modal-button-cancel" class="modal-button cancel">Cancelar</a>
            </div>
        </div>
    </div>
</div>
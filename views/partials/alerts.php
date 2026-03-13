<div class="alerts">
    <?php foreach($alerts as $type => $alerts) : ?>
        <?php foreach ($alerts as $alert) : ?>
            <div class="alert <?php echo htmlspecialchars($type) ?>">
                <p class="alert-content"><?php echo $alert ?></p>
                <p class="alert-button">X</p>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
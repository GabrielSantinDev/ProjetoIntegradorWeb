
<div class="course-thumbnail js-thumb-upload" data-id="<?= $curso->getId() ?>">

    <?php if ($curso->getImagemUrl()): ?>
        <img src="<?= $curso->getImagemUrl() ?>" alt="Thumb" class="img-fluid" />
    <?php else: ?>
        <i class="fa-solid fa-book-open thumb-default-icon"></i>
    <?php endif; ?>

    <!-- Ícone de lápis pequeno — visível sempre, some no hover -->
    <span class="thumb-edit-badge">
        <i class="fa-solid fa-pen"></i>
    </span>

    <!-- Overlay de hover — lápis grande centralizado -->
    <div class="thumb-overlay">
        <i class="fa-solid fa-pen thumb-overlay-icon"></i>
    </div>

</div><?php

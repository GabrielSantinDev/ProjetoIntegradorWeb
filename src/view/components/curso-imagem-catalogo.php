<div class="course-thumbnail js-thumb-upload" data-id="<?= $curso->getId() ?>">
    <?php if ($curso->getImagemUrl()): ?>
        <img src="<?= $curso->getImagemUrl() ?>" alt="Thumb" class="img-fluid" />
    <?php else: ?>
        <i class="fa-solid fa-book-open"></i>
    <?php endif; ?>
</div>
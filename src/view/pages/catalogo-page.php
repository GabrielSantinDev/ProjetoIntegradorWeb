<?php
$titulo = "Catálogo";
require __DIR__ . '/../templates/template-head.php';
require __DIR__ . '/../templates/template-navbar.php';

?>

    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold">Catálogo de Cursos</h2>
            <p class="text-muted-custom">Explore todos os cursos disponíveis na plataforma</p>
        </div>

        <?php if (empty($cursos)): ?>
            <div class="text-center py-5 text-muted-custom">
                Nenhum curso disponível no momento.
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($cursos as $curso): ?>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <?php require __DIR__ . '/../components/card-curso-catalogo.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

<?php require __DIR__ . '/../templates/template-footer.php'; ?>
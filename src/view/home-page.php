<?php
$titulo = "Gerenciar Cursos";
require __DIR__ . '/templates/template-head.php';
require __DIR__ . '/templates/template-navbar.php';
require __DIR__ . '/templates/template-footer.php';
?>

    <div class="container py-4">

        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold">Gerenciar Cursos</h2>
                <p class="text-muted-custom">Crie, edite e gerencie seus cursos</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCurso">
                    <i class="fa-solid fa-plus"></i> Novo Curso
                </a>
            </div>
        </div>

        <div class="course-list">
            <?php if (empty($cursos)): ?>
                <?php require __DIR__ . '/templates/card-sem-cursos.php'; ?>
            <?php else: ?>
                <?php foreach ($cursos as $curso): ?>
                    <?php require __DIR__ . '/templates/card-curso.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

<?php require __DIR__ . '/templates/modal-curso.php'; ?>

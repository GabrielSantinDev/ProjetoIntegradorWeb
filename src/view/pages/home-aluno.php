<?php
$titulo = "Meus Cursos";
require __DIR__ . '/../templates/template-head.php';
require __DIR__ . '/../templates/template-navbar.php';
?>

    <div class="container py-4">

        <!-- Meus Cursos -->
        <div class="mb-4">
            <h2 class="fw-bold">Meus Cursos</h2>
            <p class="text-muted-custom">Acompanhe seu progresso de aprendizado</p>
        </div>

        <?php if (empty($matriculas)): ?>
            <?php require __DIR__ . '/../components/card-sem-cursos-aluno.php'; ?>
        <?php else: ?>
            <div class="row g-4 mb-5">
                <?php foreach ($matriculas as $matricula): ?>
                    <div class="col-12 col-sm-4 col-lg-3">
                        <?php require __DIR__ . '/../components/card-curso-aluno.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Recomendados -->
        <?php if (!empty($recomendados)): ?>
            <div class="mb-4 mt-5">
                <h2 class="fw-bold">Cursos recomendados</h2>
                <p class="text-muted-custom">Procurando o que aprender em seguida?</p>
            </div>

            <div class="row g-4">
                <?php foreach ($recomendados as $curso): ?>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <?php require __DIR__ . '/../components/card-curso-catalogo.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

<?php require __DIR__ . '/../templates/template-footer.php'; ?>
<div class="card-aluno">

    <!-- Thumbnail -->
    <div class="card-aluno-thumb">
        <span class="card-aluno-badge">
            <?= htmlspecialchars($matricula->getCurso()->getCategoria()) ?>
        </span>

        <?php
                $curso = $matricula->getCurso();
            require __DIR__ . '/curso-imagem-catalogo.php';
        ?>

    </div>

    <!-- Conteúdo -->
    <div class="card-aluno-body">

        <h6 class="card-aluno-titulo">
            <?= htmlspecialchars($matricula->getCurso()->getTitulo()) ?>
        </h6>

        <p class="card-aluno-instrutor">
            <?= htmlspecialchars($matricula->getCurso()->getInstrutor()?->getNome() ?? 'Instrutor') ?>
        </p>

        <!-- Progresso -->
        <?php
        $progresso      = (int) round($matricula->getPorcentagemProgresso() ?? 0);
        $horasDuracao   = $matricula->getCurso()->getHorasDuracao();
        $horasAssistidas = round(($progresso / 100) * $horasDuracao, 0);
        ?>
        <div class="card-aluno-progresso-wrapper mt-auto pt-2">
            <div class="d-flex justify-content-between mb-1">
                <span class="card-aluno-meta">
                    <i class="fa-regular fa-clock"></i>
                    <?= $horasAssistidas ?>h de <?= $horasDuracao ?>h
                </span>
                <span class="card-aluno-meta fw-medium">
                    <?= $progresso ?>%
                </span>
            </div>
            <div class="progress card-aluno-progress-bar">
                <div class="progress-bar" style="width: <?= $progresso ?>%"></div>
            </div>
        </div>

        <!-- Preço -->
        <p class="card-aluno-preco">
            R$ <?= number_format($matricula->getCurso()->getPreco(), 2, ',', '.') ?>
        </p>

    </div>

</div>
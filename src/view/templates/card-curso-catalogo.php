<div class="card-aluno">

    <!-- Thumbnail -->
    <div class="card-aluno-thumb">
        <span class="card-aluno-badge">
            <?= htmlspecialchars($curso->getCategoria()) ?>
        </span>

        <?php require __DIR__ . '/curso-imagem.php'; ?>
    </div>

    <!-- Conteúdo -->
    <div class="card-aluno-body">

        <h6 class="card-aluno-titulo">
            <?= htmlspecialchars($curso->getTitulo()) ?>
        </h6>

        <p class="card-aluno-instrutor">
            <?= htmlspecialchars($curso->getInstrutor()?->getNome() ?? 'Instrutor') ?>
        </p>

        <span class="card-aluno-meta">
            <i class="fa-regular fa-clock"></i>
            <?= $curso->getHorasDuracao() ?>h de conteúdo
        </span>

        <!-- Preço + Botão -->
        <div class="d-flex align-items-center justify-content-between mt-auto pt-3">
            <p class="card-aluno-preco mb-0">
                R$ <?= number_format($curso->getPreco(), 2, ',', '.') ?>
            </p>

            <form action="<?= BASE_URL ?>/aluno/matricular" method="POST">
                <input type="hidden" name="curso_id" value="<?= $curso->getId() ?>">
                <button type="submit" class="btn btn-primary btn-sm">
                    Inscrever-se
                </button>
            </form>
        </div>

    </div>

</div>
<div class="course-card mb-3">
    <div class="card-body">
        <div class="row align-items-center">

            <!-- ESQUERDA -->
            <div class="col-12 col-md-8 col-lg-8">
                <div class="d-flex gap-4">
                    <?php require __DIR__ . '/curso-imagem.php'; ?>

                    <input type="file"
                           class="d-none js-input-image"
                           data-id="<?= $curso->getId() ?>"
                           accept="image/*">

                    <div class="flex-grow-1">
                        <div class="d-flex gap-2 mb-2 flex-wrap">
                            <span class="badge badge-category">
                                <?= $curso->getCategoria() ?>
                            </span>

                            <span class="badge <?= $curso->isPublicado() ? 'badge-public' : 'badge-private' ?>">
                                <?= $curso->isPublicado() ? 'Público' : 'Privado' ?>
                            </span>
                        </div>

                        <h4 class="fw-bold">
                            <?= $curso->getTitulo() ?>
                        </h4>

                        <p class="course-description">
                            <?= $curso->getDescricao() ?>
                        </p>

                        <div class="d-flex gap-4 mt-3">
                            <span>
                                <i class="fa-regular fa-clock"></i>
                                <?= $curso->getHorasDuracao() ?>h
                            </span>

                            <span class="fw-bold">
                                R$ <?= number_format($curso->getPreco(),2,',','.') ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DIREITA -->
            <div class="col-lg-4">

                <div class="d-flex justify-content-lg-end gap-2 mt-3 mt-lg-0 flex-wrap">

                    <button class="btn btn-card btn-card-publish js-toggle-publicacao"
                            data-id="<?= $curso->getId() ?>"
                            data-publicado="<?= $curso->isPublicado() ? 1 : 0 ?>">
                        <i class="fa-regular fa-eye"></i>
                        <?= $curso->isPublicado() ? 'Despublicar' : 'Publicar' ?>
                    </button>

                    <button class="btn btn-card btn-card-edit"
                            data-curso='<?= htmlspecialchars(json_encode([
                                    'id'           => $curso->getId(),
                                    'titulo'       => $curso->getTitulo(),
                                    'descricao'    => $curso->getDescricao(),
                                    'categoria'    => $curso->getCategoria(),
                                    'horas_duracao'=> $curso->getHorasDuracao(),
                                    'preco'        => $curso->getPreco(),
                                    'publicado'    => $curso->isPublicado(),
                            ]), ENT_QUOTES) ?>'
                            data-bs-toggle="modal"
                            data-bs-target="#modalCurso">
                        <i class="fa-solid fa-pen"></i>
                        Editar
                    </button>

                    <button
                            class="btn btn-card btn-card-remove js-remover-curso"
                            data-id="<?= $curso->getId() ?>"
                            data-titulo="<?= htmlspecialchars($curso->getTitulo()) ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#modalRemoverCurso">

                        <i class="fa-solid fa-trash"></i>
                        Remover

                    </button>

                </div>
            </div>
        </div>
    </div>

</div>
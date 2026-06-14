<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<div class="modal fade" id="modalCurso" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-skillup">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold" id="modalCursoTitulo">Novo Curso</h5>
                    <p class="text-muted-custom mb-0 small" id="modalCursoSubtitulo">
                        Preencha os dados para criar um novo curso.
                    </p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body pt-3">
                <form id="formCurso"
                      action="<?= BASE_URL ?>/instrutor/cursos/novo"
                      method="POST">

                    <!-- ID oculto — preenchido pelo JS apenas na edição -->
                    <input type="hidden" name="id" id="cursoId">

                    <!-- Título -->
                    <div class="mb-3">
                        <label class="form-label modal-label">
                            Título <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control input-skillup"
                               name="titulo"
                               id="cursoTitulo"
                               placeholder="Nome do curso">
                    </div>

                    <!-- Descrição -->
                    <div class="mb-3">
                        <label class="form-label modal-label">
                            Descrição <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control input-skillup"
                                  name="descricao"
                                  id="cursoDescricao"
                                  rows="4"
                                  placeholder="Descreva o curso"></textarea>
                    </div>

                    <!-- Preço + Carga horária -->
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label modal-label">
                                Preço (R$) <span class="text-danger">*</span>
                            </label>
                            <input type="number"
                                   class="form-control input-skillup"
                                   name="preco"
                                   id="cursoPreco"
                                   placeholder="00,00"
                                   step="0.01"
                                   min="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label modal-label">
                                Carga horária (h) <span class="text-danger">*</span>
                            </label>
                            <input type="number"
                                   class="form-control input-skillup"
                                   name="horas_duracao"
                                   id="cursoHoras"
                                   placeholder="20"
                                   step="0.5"
                                   min="0.5">
                        </div>
                    </div>

                    <!-- Categoria -->
                    <div class="mb-3">
                        <label class="form-label modal-label">
                            Categoria <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control input-skillup"
                               name="categoria"
                               id="cursoCategoria"
                               placeholder="Ex: Desenvolvimento Web">
                    </div>

                </form>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 pt-0">
                <button type="button"
                        class="btn btn-cancelar"
                        data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit"
                        form="formCurso"
                        class="btn btn-primary px-4"
                        id="btnConfirmar">
                    Criar Curso
                </button>
            </div>

        </div>
    </div>
</div>
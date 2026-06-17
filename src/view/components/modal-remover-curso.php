<div class="modal fade" id="modalRemoverCurso" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-skillup">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">
                        Remover Curso
                    </h5>

                    <p class="text-muted-custom mb-0 small">
                        Esta ação não poderá ser desfeita.
                    </p>
                </div>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <!-- BODY -->
            <div class="modal-body pt-3">

                <div class="text-center">

                    <i class="fa-solid fa-triangle-exclamation fs-1 text-danger mb-3"></i>

                    <h5 class="fw-bold mb-2">
                        Tem certeza?
                    </h5>

                    <p class="text-muted-custom mb-0">
                        Você está prestes a remover o curso
                        <strong id="cursoNomeRemocao"></strong>.
                    </p>

                </div>

                <form id="formRemoverCurso" method="POST">
                </form>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 pt-0">

                <button
                    type="button"
                    class="btn btn-cancelar"
                    data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button
                    type="submit"
                    form="formRemoverCurso"
                    class="btn btn-danger">
                    Remover
                </button>

            </div>

        </div>
    </div>
</div>
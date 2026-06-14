<?php
http_response_code(404);

$titulo = "Página não encontrada";

require __DIR__ . '/../templates/template-head.php';
?>

    <div class="container py-5">

        <div class="border-0 shadow-lg mx-auto text-center"
             style="max-width: 700px;">

            <div class="card-body p-5">

                <div class="mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-warning"
                       style="font-size: 5rem;"></i>
                </div>

                <h1 class="display-1 fw-bold text-danger">404</h1>

                <h2 class="fw-bold mb-3">
                    Página não encontrada
                </h2>

                <p class="text-muted-custom mb-4">
                    A página que você tentou acessar não existe,
                    foi removida ou o endereço informado está incorreto.
                </p>

                <div class="d-flex justify-content-center gap-3 flex-wrap">

                    <a href="<?= BASE_URL ?>/home"
                       class="btn btn-primary">
                        <i class="fa-solid fa-house"></i>
                        Início
                    </a>

                    <button onclick="history.back()"
                            class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar
                    </button>

                </div>

            </div>

        </div>

    </div>

<?php require __DIR__ . '/../templates/template-footer.php'; ?>
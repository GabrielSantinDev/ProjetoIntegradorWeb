<?php
http_response_code(403);

$titulo = "Acesso Negado";

require __DIR__ . '/../templates/template-head.php';
?>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">

        <div class="shadow-lg border-0 text-center p-5 error-card"
             style="max-width: 700px; width: 100%;">

            <div class="mb-4">
                <i class="fa-solid fa-lock text-warning"
                   style="font-size: 5rem;"></i>
            </div>

            <h1 class="display-1 fw-bold text-warning">
                403
            </h1>

            <h2 class="fw-bold mb-3">
                Acesso Negado
            </h2>

            <p class="text-muted-custom mb-4">
                Você não possui permissão para acessar esta página.
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

<?php require __DIR__ . '/../templates/template-footer.php'; ?>
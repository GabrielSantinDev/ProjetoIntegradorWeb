<?php if (!empty($_SESSION['toasts'])): ?>

    <div class="toast-container position-fixed top-0 end-0 p-3">

        <?php foreach ($_SESSION['toasts'] as $i => $toast): ?>

            <div
                class="toast align-items-center text-bg-<?= $toast['tipo'] ?> border-0 mb-2"
                role="alert"
                data-bs-autohide="true">

                <div class="d-flex">

                    <div class="toast-body">
                        <?= $toast['mensagem'] ?>
                    </div>

                    <button
                        type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toast').forEach(el => {
                new bootstrap.Toast(el, {
                    delay: 5000
                }).show();
            });
        });
    </script>

    <?php unset($_SESSION['toasts']); ?>

<?php endif; ?>
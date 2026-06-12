<?php
$titulo = "Criar conta";
require __DIR__ . '/templates/template-head.php';
?>

    <div class="auth-wrapper">

        <!-- Botão de tema -->
        <button id="theme-toggle" class="btn btn-icon auth-theme-btn" title="Alternar tema">
            <i class="fa-solid fa-moon" id="theme-icon"></i>
        </button>

        <div class="auth-card">

            <!-- Logo -->
            <div class="auth-brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <span class="brand-name">SkillUp</span>
            </div>

            <h2 class="auth-title">Criar uma conta</h2>
            <p class="auth-subtitle">Comece sua jornada de aprendizado</p>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger border-0 rounded-3 mb-3" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <form id="formCadastro"
                  action="<?= BASE_URL ?>/cadastro"
                  method="POST">

                <!-- Tipo de conta -->
                <div class="mb-4">
                    <label class="form-label modal-label">Tipo de conta</label>
                    <div class="tipo-conta-wrapper">
                        <input type="radio" name="tipo" id="tipoAluno" value="aluno" class="d-none" checked>
                        <label for="tipoAluno" class="tipo-conta-btn">
                            <i class="fa-solid fa-graduation-cap"></i> Aluno
                        </label>

                        <input type="radio" name="tipo" id="tipoInstrutor" value="instrutor" class="d-none">
                        <label for="tipoInstrutor" class="tipo-conta-btn">
                            <i class="fa-solid fa-chalkboard-user"></i> Instrutor
                        </label>
                    </div>
                </div>

                <!-- Nome -->
                <div class="mb-3">
                    <label class="form-label modal-label">Nome completo</label>
                    <input type="text"
                           class="form-control input-skillup"
                           name="nome"
                           id="cadastroNome"
                           placeholder="Seu nome"
                           autocomplete="name">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label modal-label">Email</label>
                    <input type="email"
                           class="form-control input-skillup"
                           name="email"
                           id="cadastroEmail"
                           placeholder="seu@email.com"
                           autocomplete="email">
                </div>

                <!-- Senha -->
                <div class="mb-3">
                    <label class="form-label modal-label">Senha</label>
                    <div class="input-password-wrapper">
                        <input type="password"
                               class="form-control input-skillup"
                               name="senha"
                               id="cadastroSenha"
                               placeholder="••••••••"
                               autocomplete="new-password">
                        <button type="button" class="btn-toggle-senha" id="toggleSenha" tabindex="-1">
                            <i class="fa-regular fa-eye" id="iconeSenha"></i>
                        </button>
                    </div>
                </div>

                <!-- Data de nascimento -->
                <div class="mb-1">
                    <label class="form-label modal-label">Data de nascimento</label>
                    <input type="date"
                           class="form-control input-skillup"
                           name="data_nascimento"
                           id="cadastroNascimento">
                </div>
                <p class="auth-hint" id="hintInstrutor" style="display:none;">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    É necessário ter pelo menos 18 anos para se cadastrar como instrutor (RN03).
                </p>

                <div class="mb-4"></div>

                <button type="submit" class="btn btn-primary w-100 btn-auth">
                    <i class="fa-solid fa-user-plus me-2"></i>Criar conta
                </button>

            </form>

            <p class="auth-footer-text">
                Já tem uma conta?
                <a href="<?= BASE_URL ?>/login" class="auth-link">Entrar</a>
            </p>

        </div>

    </div>

    <!-- JS específico do cadastro: mostra hint ao selecionar Instrutor -->
    <script>
        $(function () {
            $('input[name="tipo"]').on('change', function () {
                const isInstrutor = $('#tipoInstrutor').is(':checked');
                $('#hintInstrutor').toggle(isInstrutor);
            });
        });
    </script>

<?php require __DIR__ . '/templates/template-footer.php'; ?>
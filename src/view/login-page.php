<?php
$titulo = "Entrar";
require __DIR__ . '/templates/template-head.php';
?>

    <div class="auth-wrapper">

        <!-- Botão de tema (canto superior direito) -->
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

            <h2 class="auth-title">Entrar na sua conta</h2>
            <p class="auth-subtitle">Acesse sua plataforma de cursos</p>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger border-0 rounded-3 mb-3" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <form id="formLogin"
                  action="<?= BASE_URL ?>/login"
                  method="POST">

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label modal-label">Email</label>
                    <input type="email"
                           class="form-control input-skillup"
                           name="email"
                           id="loginEmail"
                           placeholder="seu@email.com"
                           autocomplete="email">
                </div>

                <!-- Senha -->
                <div class="mb-4">
                    <label class="form-label modal-label">Senha</label>
                    <div class="input-password-wrapper">
                        <input type="password"
                               class="form-control input-skillup"
                               name="senha"
                               id="loginSenha"
                               placeholder="••••••••"
                               autocomplete="current-password">
                        <button type="button" class="btn-toggle-senha" id="toggleSenha" tabindex="-1">
                            <i class="fa-regular fa-eye" id="iconeSenha"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-auth">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar
                </button>

            </form>

            <p class="auth-footer-text">
                Não tem uma conta?
                <a href="<?= BASE_URL ?>/cadastro" class="auth-link">Cadastre-se</a>
            </p>

        </div>

    </div>

<?php require __DIR__ . '/templates/template-footer.php'; ?>
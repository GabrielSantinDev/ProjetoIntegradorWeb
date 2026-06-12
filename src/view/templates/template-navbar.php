<header class="navbar-skillup sticky-top">
    <div class="container">
        <div class="navbar-wrapper">

            <!-- Logo + Menu -->
            <div class="d-flex align-items-center gap-5">
                <a href="<?= BASE_URL ?>/home" class="brand">
                    <div class="brand-icon">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <span class="brand-name">SkillUp</span>
                </a>

                <nav class="d-flex gap-2">
                    <?php if (($_SESSION['usuario']['tipo'] ?? '') === 'aluno'): ?>

                        <a href="<?= BASE_URL ?>/aluno/home"
                           class="btn btn-skillup-soft <?= str_contains($_SERVER['REQUEST_URI'], '/aluno/home') ? 'active' : '' ?>">
                            Meus Cursos
                        </a>

                        <a href="<?= BASE_URL ?>/aluno/catalogo"
                           class="btn btn-skillup-soft <?= str_contains($_SERVER['REQUEST_URI'], '/aluno/catalogo') ? 'active' : '' ?>">
                            Catálogo
                        </a>

                    <?php else: ?>

                        <a href="<?= BASE_URL ?>/instrutor/home"
                           class="btn btn-skillup-soft <?= str_contains($_SERVER['REQUEST_URI'], '/instrutor/home') ? 'active' : '' ?>">
                            Meus Cursos
                        </a>

                    <?php endif; ?>
                </nav>

            </div>

            <!-- User Area -->
            <div class="d-flex align-items-center gap-4">
                <div class="user-info">
                    <i class="fa-solid fa-user-circle"></i>
                    <div>
                        <div class="user-name"><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></div>
                        <div class="user-role"><?= ucfirst($_SESSION['usuario']['tipo']) ?></div>
                    </div>
                </div>

                <!-- Dark mode -->
                <button id="theme-toggle" class="btn btn-icon">
                    <i class="fa-solid fa-moon" id="theme-icon"></i>
                </button>

                <!-- Logout -->
                <a href="<?= BASE_URL ?>/logout" class="btn btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Sair
                </a>
            </div>

        </div>
    </div>
</header>
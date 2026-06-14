<header class="navbar-skillup sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-md py-2">

            <!-- Brand -->
            <a href="<?= BASE_URL ?>/home" class="brand navbar-brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <span class="brand-name">SkillUp</span>
            </a>

            <!-- Toggler que só aparece abaixo de lg -->
            <button class="navbar-toggler navbar-toggler-skillup" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSkillup"
                    aria-controls="navbarSkillup"
                    aria-expanded="false"
                    aria-label="Abrir menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Conteúdo colapsável -->
            <div class="collapse navbar-collapse" id="navbarSkillup">

                <!-- Links de navegação -->
                <ul class="navbar-nav me-auto mt-3 mt-lg-0 gap-2">
                    <?php if (($_SESSION['usuario']['tipo'] ?? '') === 'aluno'): ?>

                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/aluno/home"
                               class="btn btn-skillup-soft <?= str_contains($_SERVER['REQUEST_URI'], '/aluno/home') ? 'active' : '' ?>">
                                Meus Cursos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/aluno/catalogo"
                               class="btn btn-skillup-soft <?= str_contains($_SERVER['REQUEST_URI'], '/aluno/catalogo') ? 'active' : '' ?>">
                                Catálogo
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/instrutor/home"
                               class="btn btn-skillup-soft <?= str_contains($_SERVER['REQUEST_URI'], '/instrutor/home') ? 'active' : '' ?>">
                                Meus Cursos
                            </a>
                        </li>

                    <?php endif; ?>
                </ul>

                <!-- Área do usuário -->
                <div class="navbar-user-area mt-3 mt-lg-0">

                    <div class="user-info">
                        <i class="fa-solid fa-user-circle"></i>
                        <div>
                            <div class="user-name"><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></div>
                            <div class="user-role"><?= ucfirst($_SESSION['usuario']['tipo']) ?></div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
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

        </nav>
    </div>
</header>
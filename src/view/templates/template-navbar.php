<header class="navbar-skillup sticky-top">

    <div class="container">

        <div class="navbar-wrapper">

            <!-- Logo + Menu -->
            <div class="d-flex align-items-center gap-5">

                <a
                    href="<?= BASE_URL ?>"
                    class="brand">

                    <div class="brand-icon">

                        <i class="fa-solid fa-graduation-cap"></i>

                    </div>

                    <span class="brand-name">
                        SkillUp
                    </span>

                </a>

                <nav>

                    <a
                        href="<?= BASE_URL ?>/cursos"
                        class="btn btn-skillup-soft">

                        Meus Cursos

                    </a>

                </nav>

            </div>

            <!-- User Area -->
            <div class="d-flex align-items-center gap-4">

                <div class="user-info">

                    <i class="fa-solid fa-user-circle"></i>

                    <div>

                        <div class="user-name">
                            Usuario
                        </div>

                        <div class="user-role">
                            Instrutor
                        </div>

                    </div>

                </div>

                <!-- Cor tema -->
                <button
                    class="btn btn-icon">

                    <i class="fa-solid fa-palette"></i>

                </button>

                <!-- Dark mode -->
                <button
                    id="theme-toggle"
                    class="btn btn-icon">

                    <i class="fa-solid fa-moon"></i>

                </button>

                <!-- Logout -->
                <a
                    href="#"
                    class="btn btn-logout">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Sair

                </a>

            </div>

        </div>

    </div>

</header>
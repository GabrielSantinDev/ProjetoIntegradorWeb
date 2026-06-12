<?php

namespace controller;

use dao\AlunoDAO;
use dao\InstrutorDAO;
use model\Aluno;
use model\Instrutor;

class UsuarioController
{

    public function home(): void //direcionad o usuario pra home-aluno ou home-instrutor
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (strtolower($_SESSION['usuario']['tipo']) == 'instrutor') {
            header('Location: ' . BASE_URL . '/instrutor/home');
            exit;
        } else {
            header('Location: ' . BASE_URL . '/aluno/home');
        }
    }

    // =========================================================
    // GET /login — exibe a tela de login
    // =========================================================
    public function login(): void
    {
        // Já logado → redireciona direto
        if (isset($_SESSION['usuario'])) {
            if (strtolower($_SESSION['usuario']['tipo']) === 'instrutor') {
                header('Location: ' . BASE_URL . '/instrutor/home');
            } else {
                header('Location: ' . BASE_URL . '/aluno/home');
            }

            exit;
        }
        require __DIR__ . '/../view/login-page.php';
    }

    // =========================================================
    // POST /login — processa o formulário
    // =========================================================
    public function autenticar(): void
    {
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($email) || empty($senha)) {
                throw new \Exception("Preencha o email e a senha.");
            }

            // Procura primeiro em Instrutor, depois em Aluno
            // (MappedSuperclass não tem tabela própria, então buscamos nas filhas)
            $usuario = InstrutorDAO::buscarPorEmail($email)
                ?? AlunoDAO::buscarPorEmail($email);

            if (!$usuario) {
                throw new \Exception("Email ou senha incorretos.");
            }

            if (!password_verify($senha, $usuario->getSenha())) {
                throw new \Exception("Email ou senha incorretos.");
            }

            // Salva na sessão o que a aplicação vai precisar
            $_SESSION['usuario'] = [
                'id'   => $usuario->getId(),
                'nome' => $usuario->getNome(),
                'tipo' => $usuario instanceof Instrutor ? 'instrutor' : 'aluno',
            ];

            header('Location: ' . BASE_URL . '/login');
            exit;

        } catch (\Exception $ex) {
            $erro = "Ocorreu um erro ao fazer login. Tente novamente mais tarde.";
            require __DIR__ . '/../view/login-page.php';
        }
    }

    // =========================================================
    // GET /cadastro — exibe a tela de cadastro
    // =========================================================
    public function cadastro(): void
    {
        // Já logado → redireciona direto
        if (isset($_SESSION['usuario'])) {
            if (strtolower($_SESSION['usuario']['tipo']) === 'instrutor') {
                header('Location: ' . BASE_URL . '/instrutor/home');
            } else {
                header('Location: ' . BASE_URL . '/aluno/home');
            }

            exit;
        }

        require __DIR__ . '/../view/cadastro-page.php';
    }

    // =========================================================
    // POST /cadastro — processa o formulário
    // =========================================================
    public function registrar(): void
    {
        try {
            $nome           = filter_input(INPUT_POST, 'nome',            FILTER_SANITIZE_SPECIAL_CHARS);
            $email          = filter_input(INPUT_POST, 'email',           FILTER_SANITIZE_EMAIL);
            $senha          = filter_input(INPUT_POST, 'senha',           FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo           = filter_input(INPUT_POST, 'tipo',            FILTER_SANITIZE_SPECIAL_CHARS);
            $dataNascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_SPECIAL_CHARS);

            // Validações básicas
            if (empty($nome) || empty($email) || empty($senha) || empty($dataNascimento)) {
                throw new \Exception("Preencha todos os campos obrigatórios.");
            }

            // RN03 — instrutor precisa ter 18+
            $nascimento = new \DateTime($dataNascimento);
            $idade      = (new \DateTime())->diff($nascimento)->y;

            if ($tipo === 'instrutor' && $idade < 18) {
                throw new \Exception("É necessário ter pelo menos 18 anos para se cadastrar como instrutor.");
            }

            // Verifica email duplicado nas duas tabelas
            $jaExiste = InstrutorDAO::buscarPorEmail($email)
                ?? AlunoDAO::buscarPorEmail($email);

            if ($jaExiste) {
                throw new \Exception("Este email já está cadastrado.");
            }

            // Cria o objeto correto dependendo do tipo
            if ($tipo === 'instrutor') {
                $usuario = new Instrutor();
                $usuario->setEspecializacao("");
                $usuario->setDescricao("");
                $usuario->setAvaliacao(0.0);
            } else {
                $usuario = new Aluno();
                $usuario->setNivelAprendizado("Iniciante");
            }

            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setSenha(password_hash($senha, PASSWORD_DEFAULT));
            $usuario->setDataNascimento($nascimento);
            $usuario->setDataCadastro(new \DateTime());

            // Salva na tabela correta via DAO correspondente
            if ($tipo === 'instrutor') {
                InstrutorDAO::salvar($usuario);
            } else {
                AlunoDAO::salvar($usuario);
            }

            header('Location: ' . BASE_URL . '/login');
            exit;

        } catch (\Exception $ex) {
            $erro = "Ocorreu um erro ao se cadastrar. Tente novamente mais tarde.";
            require __DIR__ . '/../view/cadastro-page.php';
        }
    }

    // =========================================================
    // GET /logout
    // =========================================================
    public function logout(): void
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
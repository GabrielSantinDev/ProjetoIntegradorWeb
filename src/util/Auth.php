<?php

namespace utils;

use model\Instrutor;
use model\Usuario;

// ============================================================================================================
// =========== Facade que encapsula toda a lógica de autenticação, sessão e autorização do sistema =============
class Auth
{
    // =========================================================
    // Leitura
    // =========================================================

    public static function estaLogado(): bool{ return isset($_SESSION['usuario']); }
    public static function getUsuario(): ?array{ return $_SESSION['usuario'] ?? null; }

    public static function getId(): ?int
    {
        return $_SESSION['usuario']['id'] ?? null;
    }

    public static function getNome(): ?string
    {
        return $_SESSION['usuario']['nome'] ?? null;
    }

    public static function getTipo(): ?string
    {
        return $_SESSION['usuario']['tipo'] ?? null;
    }

    public static function isInstrutor(): bool
    {
        return self::getTipo() === 'instrutor';
    }

    public static function isAluno(): bool
    {
        return self::getTipo() === 'aluno';
    }

    // =========================================================
    // Escrita
    // =========================================================

    /**
     * Salva o usuario autenticado na sessao e determina o tipo automaticamente pela classe do model
     */
    public static function login(Usuario $usuario): void
    {
        $_SESSION['usuario'] = [
            'id'   => $usuario->getId(),
            'nome' => $usuario->getNome(),
            'tipo' => $usuario instanceof Instrutor ? 'instrutor' : 'aluno',
        ];
    }

    public static function logout(): void
    {
        session_destroy();
    }

    /**
     * Garante que existe um usuaario logado. Se nao, redireciona para o login e encerra a execuçao
     */
    public static function exigirLogin(): void
    {
        if (!self::estaLogado()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    /**
     * Garante que o usuario logado é do tipo esperado aluno ou instrutor
     * Se nao, redireciona para a home correspondente ao tipo dele.
     */
    public static function exigirTipo(string $tipoEsperado): void
    {
        self::exigirLogin();

        if (self::getTipo() !== strtolower($tipoEsperado)) {
            http_response_code(403);
            require __DIR__ . '/../view/pages/error-403.php';

            exit;
        }

    }

    /**
     * Redireciona para a home correta dependendo do tipo do usuaario logado
     */
    public static function redirecionarParaHome(): void
    {
        $destino = self::isInstrutor() ? '/instrutor/home' : '/aluno/home';

        header('Location: ' . BASE_URL . $destino);
        exit;
    }
}
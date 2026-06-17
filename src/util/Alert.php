<?php

namespace utils;
class Alert
{
    public static function add(string $tipo, string $mensagem): void
    {
        $_SESSION['toasts'][] = [
            'tipo' => $tipo,
            'mensagem' => $mensagem
        ];
    }

    public static function success(string $msg): void
    {
        self::add('success', $msg);
    }

    public static function error(string $msg): void
    {
        self::add('danger', $msg);
    }

    public static function warning(string $msg): void
    {
        self::add('warning', $msg);
    }

    public static function info(string $msg): void
    {
        self::add('info', $msg);
    }
}
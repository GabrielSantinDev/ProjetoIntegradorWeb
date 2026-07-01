<?php

namespace utils;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class Conexao {
    private static $entityManager;

    // Comando de update classes:  D:\xampp\php\php.exe doctrine.php orm:schema-tool:update --force
    public static function getEntityManager() {
        if (self::$entityManager === null) {
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [realpath(__DIR__ . '/../model')],
                isDevMode: false,
            );

            $connection = DriverManager::getConnection([
                'driver' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'dbname' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],

                'driverOptions' => [
                    \PDO::MYSQL_ATTR_SSL_CA => realpath(__DIR__ . '/../../certs/ca.pem'),
                ],
            ], $config);

            self::$entityManager = new EntityManager($connection, $config);
        }
        return self::$entityManager;
    }
}
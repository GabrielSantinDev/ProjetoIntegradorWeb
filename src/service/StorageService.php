<?php

namespace service;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Dotenv\Dotenv;

class StorageService
{
    private Cloudinary $cloudinary;

    public function __construct()
    {

        // Inicializa a configuração global do Cloudinary a partir do .env
        $config = [
            // garante que o Cloudinary está configurado ANTES de usar
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'] ?? null,
                'api_key'    => $_ENV['CLOUDINARY_API_KEY'] ?? null,
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET'] ?? null,
            ],
            'url' => [
                'secure' => true
            ]
        ];

        // Cria uma instância singleton da configuração (pode ser reutilizada)
        $configuration = Configuration::instance($config);

        // Passe explicitamente a configuração para o construtor do Cloudinary.
        // O construtor padrão cria uma nova Configuration(NULL) e tenta ler
        // a variável de ambiente CLOUDINARY_URL, o que falha se não estiver setada.
        $this->cloudinary = new Cloudinary($configuration);
    }

    /**
     * Upload de imagem pro Cloudinary
     */
    public function uploadImage(array $file, string $folder = 'uploads'): array
    {
        if (empty($file['tmp_name'])) {
            throw new \Exception("Arquivo inválido para upload.");
        }

        $result = $this->cloudinary->uploadApi()->upload(
            $file['tmp_name'],
            [
                'folder' => $folder
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id']
        ];
    }

    /**
     * Deletar imagem pelo public_id
     */
    public function deleteImage(string $publicId): void
    {
        if (!$publicId) return;

        $this->cloudinary->uploadApi()->destroy($publicId);
    }
}
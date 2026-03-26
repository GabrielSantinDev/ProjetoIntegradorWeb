<?php
namespace test\model;
use model\Aluno;
use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase {

    // 1 - Baixar o Composer;
    // 2 - Usar o comando "composer init" dentro do projeto;
    // 3 - Adicionar as dependências do PHPUnit e do dotenv usando o comando "composer require phpunit/phpunit vlucas/phpdotenv";
    // 4 - Configurar os caminhos dos namespaces no arquivo "composer.json" usando a seção "autoload";
    // 5 - Rodar o comando "composer dump-autoload" para gerar o autoload dos namespaces;
    // 6 - Criar a classe de teste e usar o namespace correto para importar a classe Cliente;
    // 7 - Escrever os métodos de teste usando as asserções do PHPUnit para verificar o comportamento da classe Cliente.
    // 8 - Configurar o PHPUnit com o PHPStorm, na seção específica das "configurações->PHP->Test Frameworks" e informando o caminho do composer autoload do projeto.

    public function testCriarObjeto(){
        $aluno = new Aluno();
        $aluno->setNome("Gabriel");
        $aluno->setEmail("gabriel@email.com");

        $this->assertNotNull($aluno);
    }

}

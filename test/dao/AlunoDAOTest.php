<?php

namespace test\dao;

use dao\AlunoDAO;
use model\Aluno;

class AlunoDAOTest extends \PHPUnit\Framework\TestCase {

    private function inserirAluno() {
        $aluno = new Aluno();
        $aluno->setNome("Gabriel");
        $aluno->setEmail("gabriel@email.com");
        $aluno->setSenha("12345");
        $aluno->setDataNascimento(new \DateTime("2006-01-01"));
        $aluno->setDataCadastro(new \DateTime("now"));
        $aluno->setNivelAprendizado("Iniciante");
        $alunoInserido = AlunoDAO::salvar($aluno);
        return $alunoInserido;
    }
    public function testInserir() {

        $alunoInserido = $this->inserirAluno();

        $this->assertNotNull($alunoInserido->getId());
    }

    public function testAlterar() {
        $alunoInserido = $this->inserirAluno();

        $alunoAlterarId = $alunoInserido->getId();
        $alunoInserido->setNome("Gabriel Alterar");

        AlunoDAO::salvar($alunoInserido);
        $alunoAlterado = AlunoDAO::buscarId($alunoAlterarId);
        $alunoAlterarNome = $alunoAlterado->getNome();
        $this->assertEquals($alunoAlterarNome, "Gabriel Alterar");
    }
    public function testListar(){
        $alunos = AlunoDAO::listar();
        foreach ($alunos as $aluno){
            echo $aluno->getNome(). "\n";
        }

        $this->assertNotNull($alunos);
    }

    public function testBuscarId(){
        $alunoInserido = $this->inserirAluno();

        $alunoBuscado = AlunoDAO::buscarId($alunoInserido->getId());
        $this->assertNotNull($alunoBuscado->getId());
    }

    public function testDeletar(){
        $alunoInserido = $this->inserirAluno();

        $alunoDeletarId = $alunoInserido->getId();

        AlunoDAO::deletar($alunoInserido);

        $alunoDeletado = AlunoDAO::buscarId($alunoDeletarId);
        $this->assertNull($alunoDeletado);

    }

    public function testBuscarNome(){
        $alunoInserido = $this->inserirAluno();

        $alunosBuscados = AlunoDAO::buscarNome("Gabriel");
        $this->assertNotEmpty($alunosBuscados);
    }

    public function testBuscarNomeParecido(){
        $alunoInserido = $this->inserirAluno();

        $alunosBuscados = AlunoDAO::buscarNomeParecido("Gabriel");
        $this->assertNotEmpty($alunosBuscados);
    }
}
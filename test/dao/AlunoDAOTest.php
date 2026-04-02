<?php

namespace test\dao;

use dao\AlunoDAO;
use model\Aluno;

class AlunoDAOTest extends \PHPUnit\Framework\TestCase {

    public function testInserir() {
        $aluno = new Aluno();
        $aluno->setNome("Gabriel");
        $aluno->setEmail("gabriel@email.com");
        $aluno->setSenha("12345");
        $aluno->setDataNascimento(new \DateTime("2006-01-01"));
        $aluno->setDataCadastro(new \DateTime("now"));
        $alunoInserido = AlunoDAO::salvar($aluno);

        $this->assertNotNull($alunoInserido->getId());
    }

    public function testListar(){
        $alunos = AlunoDAO::listar();
        foreach ($alunos as $aluno){
            echo $aluno->getNome(). "\n";
        }

        $this->assertNotNull($alunos);
    }

    public function testBuscarId(){
        $aluno = new Aluno();
        $aluno->setNome("Gabriel");
        $aluno->setEmail("gabriel@email.com");
        $aluno->setSenha("12345");
        $alunoInserido = AlunoDAO::salvar($aluno);

        $alunoBuscado = AlunoDAO::buscarId($aluno->getId());
        $this->assertNotNull($alunoBuscado->getId());
    }

    public function testDeletar(){
        $aluno = new Aluno();
        $aluno->setNome("Gabriel Deletar");
        $aluno->setEmail("gabriel@email.com");
        $aluno->setSenha("12345");
        $alunoInserido = AlunoDAO::salvar($aluno);

        $idDeletar = $alunoInserido->getId();
        AlunoDAO::deletar($idDeletar);

        $alunoDeletado = AlunoDAO::buscarId($idDeletar);
        $this->assertNull($alunoDeletado);

    }
}
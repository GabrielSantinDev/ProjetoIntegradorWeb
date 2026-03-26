<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_avaliacao')]
class Avaliacao extends GenericModel
{
    #[ORM\JoinColumn(name: 'curso_id')]
    #[ORM\ManyToOne(targetEntity: Curso::class)]
    private $curso;

    #[ORM\JoinColumn(name: 'aluno_id')]
    #[ORM\ManyToOne(targetEntity: Aluno::class)]
    private $aluno;

    #[ORM\Column(type: 'string')]
    private $descricao;

    #[Column(type: "decimal", precision: 10, scale: 2)]
    private $valor;

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param mixed $curso
     */
    public function setCurso($curso): void
    {
        $this->curso = $curso;
    }

    /**
     * @return mixed
     */
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * @param mixed $aluno
     */
    public function setAluno($aluno): void
    {
        $this->aluno = $aluno;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor): void
    {
        $this->valor = $valor;
    }


}

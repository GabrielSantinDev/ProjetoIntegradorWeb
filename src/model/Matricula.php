<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_matricula')]
class Matricula extends GenericModel
{
    #[ORM\JoinColumn(name: 'curso_id')]
    #[ORM\ManyToOne(targetEntity: Curso::class)]
    private $curso;

    #[ORM\JoinColumn(name: 'aluno_id')]
    #[ORM\ManyToOne(targetEntity: Aluno::class)]
    private $aluno;

    #[ORM\Column(type: 'float')]
    private $porcentagem_progresso;

    #[ORM\Column(type: 'boolean')]
    private $concluido;

    #[ORM\Column(type: 'datetime')]
    private $data_matricula;

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
    public function getPorcentagemProgresso()
    {
        return $this->porcentagem_progresso;
    }

    /**
     * @param mixed $porcentagem_progresso
     */
    public function setPorcentagemProgresso($porcentagem_progresso): void
    {
        $this->porcentagem_progresso = $porcentagem_progresso;
    }

    /**
     * @return mixed
     */
    public function getConcluido()
    {
        return $this->concluido;
    }

    /**
     * @param mixed $concluido
     */
    public function setConcluido($concluido): void
    {
        $this->concluido = $concluido;
    }

    /**
     * @return mixed
     */
    public function getDataMatricula()
    {
        return $this->data_matricula;
    }

    /**
     * @param mixed $data_matricula
     */
    public function setDataMatricula($data_matricula): void
    {
        $this->data_matricula = $data_matricula;
    }

}
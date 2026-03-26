<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_instrutor')]
class Instrutor extends GenericModel
{
    #[ORM\OneToMany(targetEntity: Curso::class, mappedBy: "instrutor", cascade: ["all"]
        , orphanRemoval: true)]
    private $cursos_criados;
    #[ORM\Column(type: 'string')]
    private $especializacao;
    #[ORM\Column(type: 'string')]
    private $descricao;
    #[ORM\Column(type: 'float')]
    private $avaliacao;
    #[Column(type: "decimal", precision: 10, scale: 2)]
    private $ganhos_totais;

    /**
     * @return mixed
     */
    public function getCursosCriados()
    {
        return $this->cursos_criados;
    }

    /**
     * @param mixed $cursos_criados
     */
    public function setCursosCriados($cursos_criados): void
    {
        $this->cursos_criados = $cursos_criados;
    }

    /**
     * @return mixed
     */
    public function getEspecializacao()
    {
        return $this->especializacao;
    }

    /**
     * @param mixed $especializacao
     */
    public function setEspecializacao($especializacao): void
    {
        $this->especializacao = $especializacao;
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
    public function getAvaliacao()
    {
        return $this->avaliacao;
    }

    /**
     * @param mixed $avaliacao
     */
    public function setAvaliacao($avaliacao): void
    {
        $this->avaliacao = $avaliacao;
    }

    /**
     * @return mixed
     */
    public function getGanhosTotais()
    {
        return $this->ganhos_totais;
    }

    /**
     * @param mixed $ganhos_totais
     */
    public function setGanhosTotais($ganhos_totais): void
    {
        $this->ganhos_totais = $ganhos_totais;
    }

}
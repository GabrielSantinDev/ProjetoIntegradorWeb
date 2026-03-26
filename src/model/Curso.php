<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_curso')]
class Curso extends GenericModel
{

    #[ORM\JoinColumn(name: 'instrutor_id')]
    #[ORM\ManyToOne(targetEntity: Curso::class)]
    private $instrutor;
    #[ORM\OneToMany(targetEntity: Matricula::class, mappedBy: "curso", cascade: ["all"]
        , orphanRemoval: true)]
    private $matriculas;
    #[ORM\Column(type: 'string')]
    private $titulo;
    #[ORM\Column(type: 'string')]
    private $categoria;
    #[ORM\Column(type: 'float')]
    private $horas_duracao;
    #[Column(type: "decimal", precision: 10, scale: 2)]
    private $preco;
    #[ORM\Column(type: 'string')]
    private $descricao;
    #[ORM\OneToMany(targetEntity: Avaliacao::class, mappedBy: "curso", cascade: ["all"]
        , orphanRemoval: true)]
    private $avaliacoes;

    /**
     * @return mixed
     */
    public function getInstrutor()
    {
        return $this->instrutor;
    }

    /**
     * @param mixed $instrutor
     */
    public function setInstrutor($instrutor): void
    {
        $this->instrutor = $instrutor;
    }

    /**
     * @return mixed
     */
    public function getMatriculas()
    {
        return $this->matriculas;
    }

    /**
     * @param mixed $matriculas
     */
    public function setMatriculas($matriculas): void
    {
        $this->matriculas = $matriculas;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getHorasDuracao()
    {
        return $this->horas_duracao;
    }

    /**
     * @param mixed $horas_duracao
     */
    public function setHorasDuracao($horas_duracao): void
    {
        $this->horas_duracao = $horas_duracao;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco): void
    {
        $this->preco = $preco;
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
    public function getAvaliacoes()
    {
        return $this->avaliacoes;
    }

    /**
     * @param mixed $avaliacoes
     */
    public function setAvaliacoes($avaliacoes): void
    {
        $this->avaliacoes = $avaliacoes;
    }

}

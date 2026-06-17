<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_curso')]
class Curso extends GenericModel
{

    #[ORM\ManyToOne(targetEntity: Instrutor::class, inversedBy: 'cursos_criados')]
    #[ORM\JoinColumn(name: 'instrutor_id')]
    private $instrutor = null;
    #[ORM\OneToMany(targetEntity: Matricula::class, mappedBy: "curso")]
    private $matriculas;
    #[ORM\Column(type: 'string')]
    private $titulo;
    #[ORM\Column(type: 'string')]
    private $categoria;
    #[ORM\Column(type: 'float')]
    private $horas_duracao;
    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $preco;
    #[ORM\Column(type: 'string')]
    private $descricao;

    #[ORM\Column(type: 'boolean')]
    private $publicado;
    #[ORM\OneToMany(targetEntity: Avaliacao::class, mappedBy: "curso")]
    private $avaliacoes;

    #[ORM\Column(type: 'string', nullable: true)]
    private $imagem_url;

    #[ORM\Column(type: 'string', nullable: true)]
    private $imagem_public_id;

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

    /**
     * @return mixed
     */
    public function isPublicado()
    {
        return $this->publicado;
    }

    /**
     * @param mixed $publicado
     */
    public function setPublicado($publicado): void
    {
        $this->publicado = $publicado;
    }

    public function getImagemUrl()
    {
        return $this->imagem_url;
    }

    public function setImagemUrl($imagem_url): void
    {
        $this->imagem_url = $imagem_url;
    }

    public function getImagemPublicId()
    {
        return $this->imagem_public_id;
    }

    public function setImagemPublicId($imagem_public_id): void
    {
        $this->imagem_public_id = $imagem_public_id;
    }

}

<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_aluno')]
class Aluno extends \model\Usuario
{
    #[ORM\OneToMany(targetEntity: Matricula::class, mappedBy: "aluno", cascade: ["all"]
        , orphanRemoval: true)]
    private $matriculas;

    #[ORM\Column(type: 'string')]
    private $nivel_aprendizado;

    #[ORM\OneToMany(targetEntity: Avaliacao::class, mappedBy: "aluno", cascade: ["all"]
        , orphanRemoval: true)]
    private $avaliacoes;

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
    public function getNivelAprendizado()
    {
        return $this->nivel_aprendizado;
    }

    /**
     * @param mixed $nivel_aprendizado
     */
    public function setNivelAprendizado($nivel_aprendizado): void
    {
        $this->nivel_aprendizado = $nivel_aprendizado;
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

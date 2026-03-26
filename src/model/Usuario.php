<?php

namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class Usuario extends GenericModel {

    #[ORM\Column(type: 'string')]
    private $nome;
    #[ORM\Column(type: 'string')]
    private $email;
    #[ORM\Column(type: 'string')]
    private $senha;
    #[ORM\Column(type: 'date')]
    private $data_nascimento;
    #[ORM\Column(type: 'datetime')]
    private $data_cadastro;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * @param mixed $data_nascimento
     */
    public function setDataNascimento($data_nascimento): void
    {
        $this->data_nascimento = $data_nascimento;
    }

    /**
     * @return mixed
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param mixed $data_cadastro
     */
    public function setDataCadastro($data_cadastro): void
    {
        $this->data_cadastro = $data_cadastro;
    }



}
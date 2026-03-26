<?php
// Os namespaces ajudam a organizar o código
// São semelhantes aos pacotes no Java
namespace model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
abstract class GenericModel {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
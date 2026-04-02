<?php

namespace dao;

use Exception;
use model\Instrutor;
use utils\Conexao;

class InstrutorDAO extends GenericDAO
{
    protected static $modelClass = Instrutor::class;

    // Utiliza "Magic Finders" construídas pelo repository do Doctrine  conforme os atributos da classe alvo mapeados
    public static function buscarNome($nome)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Instrutor::class);
            // Usando a chamada "mágica" o doctrine reconhece o "nome" como um atributo de "Instrutor" e compreender que desejamos buscar pelo atributo "nome"
            // Existem diferentes combinações e padrões que podem ser usadas nestas chamadas mágicas.
            return $repository->findByNome($nome);
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar Instrutor pelo nome. " . $ex->getMessage());
        }
    }

    // Utiliza DQL - Doctrine Query Language
    public static function buscarNomeParecido($nome){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT i FROM model\Instrutor i WHERE i.nome LIKE :nome");
            $query->setParameter("nome", "%" . $nome . "%");
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar Instrutor pelo nome. " . $ex->getMessage());
        }
    }
}
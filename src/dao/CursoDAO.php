<?php

namespace dao;

use Exception;
use model\Curso;
use utils\Conexao;

class CursoDAO extends GenericDAO
{
    protected static $modelClass = Curso::class;
    public static function buscarTituloParecido($titulo){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT c FROM model\Curso c WHERE c.titulo LIKE :titulo");
            $query->setParameter("titulo", "%" . $titulo . "%");
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar Curso pelo titulo. " . $ex->getMessage());
        }
    }

    public static function buscarPorInstrutorId($instrutor){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT c FROM model\Curso c WHERE c.instrutor_id = :instrutor");
            $query->setParameter("instrutor", $instrutor);
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar por Instrutor. " . $ex->getMessage());
        }
    }

    public static function buscarCategoria($categoria)
    {
        try {
            $em = Conexao::getEntityManager();
            $repository = $em->getRepository(Curso::class);

            return $repository->findByCategoria($categoria);
        } catch (Exception $ex) {
            throw new Exception("Falha ao buscar Curso por categoria. " . $ex->getMessage());
        }
    }
}
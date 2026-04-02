<?php

namespace dao;

use Exception;
use model\Matricula;
use utils\Conexao;

class MatriculaDAO extends GenericDAO
{
    protected static $modelClass = Matricula::class;

    public static function buscarPorAlunoId($aluno){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT m FROM model\Matricula m WHERE m.aluno_id = :aluno");
            $query->setParameter("aluno", $aluno);
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar por Aluno. " . $ex->getMessage());
        }
    }

    public static function buscarPorCursoId($curso){
        try {
            $em = Conexao::getEntityManager();
            $query = $em->createQuery("SELECT m FROM model\Matricula m WHERE m.curso_id = :curso");
            $query->setParameter("curso", $curso);
            return $query->getResult();
        } catch (Exception $ex){
            throw new Exception("Falha ao buscar por Curso. " . $ex->getMessage());
        }
    }


}
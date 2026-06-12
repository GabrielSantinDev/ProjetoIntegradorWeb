<?php

namespace dao;

use Exception;
use model\Matricula;
use utils\Conexao;

class MatriculaDAO extends GenericDAO
{
    protected static $modelClass = Matricula::class;


    public static function listarPorAluno(int $alunoId): array
    {
        try {
            $em         = \utils\Conexao::getEntityManager();
            $repository = $em->getRepository(Matricula::class);
            return $repository->findBy(['aluno' => $alunoId]);
        } catch (\Exception $ex) {
            throw new \Exception("Falha ao listar matrículas do aluno. " . $ex->getMessage());
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

    public static function buscarPorAlunoECurso(int $alunoId, int $cursoId): ?Matricula
    {
        try {
            $em         = \utils\Conexao::getEntityManager();
            $repository = $em->getRepository(Matricula::class);
            return $repository->findOneBy([
                'aluno' => $alunoId,
                'curso' => $cursoId,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception("Falha ao buscar matrícula. " . $ex->getMessage());
        }
    }



}
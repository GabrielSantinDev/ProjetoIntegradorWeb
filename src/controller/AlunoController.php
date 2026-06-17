<?php

namespace controller;
use dao\CursoDAO;
use dao\MatriculaDAO;
use utils\Alert;
use utils\Auth;

class AlunoController
{

    public function homeAluno(): void //direcionad o usuario pra home-aluno ou home-instrutor
    {
        Auth::exigirTipo('aluno');

        try {

            $alunoId = Auth::getId();

            $matriculas = MatriculaDAO::listarPorAluno($alunoId);

            // IDs dos cursos que o aluno já está matriculado
            $cursosMatriculadosIds = array_map(
                fn($m) => $m->getCurso()->getId(),
                $matriculas
            );

            // Todos os cursos publicados que ele NÃO está matriculado
            $todosCursos = CursoDAO::listarPublicados();
            $recomendados = array_filter(
                $todosCursos,
                fn($c) => !in_array($c->getId(), $cursosMatriculadosIds)
            );

            // Pega só os 4 primeiros
            $recomendados = array_slice(array_values($recomendados), 0, 4);

            require __DIR__ . '/../view/pages/home-aluno.php';

        } catch (\Exception $ex) {
            $erro = $ex->getMessage();
            require __DIR__ . '/../view/pages/error-404.php';
        }
    }

    public function catalogo(): void
    {
        Auth::exigirTipo('aluno');

        try {
            $alunoId = Auth::getId();
            $matriculas = MatriculaDAO::listarPorAluno($alunoId);

            $cursosMatriculadosIds = array_map(
                fn($m) => $m->getCurso()->getId(),
                $matriculas
            );

            // Todos os publicados, filtrando os que já esta matriculados
            $cursos = array_filter(
                CursoDAO::listarPublicados(),
                fn($c) => !in_array($c->getId(), $cursosMatriculadosIds)
            );
            $cursos = array_values($cursos);

            require __DIR__ . '/../view/pages/catalogo-page.php';

        } catch (\Exception $ex) {
            $erro = $ex->getMessage();
            require __DIR__ . '/../view/pages/error-404.php';
        }
    }

    public function matricular(): void
    {
        Auth::exigirLogin();

        $alunoId = Auth::getId();

        try {
            $cursoId = filter_input(INPUT_POST, 'curso_id', FILTER_VALIDATE_INT);

            if (!$cursoId) {
                throw new \Exception("Curso inválido.");
            }

            // Verifica se já está matriculado
            $jaMatriculado = MatriculaDAO::buscarPorAlunoECurso($alunoId, $cursoId);
            if ($jaMatriculado) {
                Alert::error("Erro: Você já está matriculado neste curso!");
                throw new \Exception("Erro: Você já está matriculado neste curso!");
            }

            $curso = \dao\CursoDAO::buscarId($cursoId);
            if (!$curso) {
                throw new \Exception("Curso não encontrado.");
            }

            $aluno = \dao\AlunoDAO::buscarId($alunoId);
            if (!$aluno) {
                throw new \Exception("Aluno não encontrado.");
            }

            $matricula = new \model\Matricula();
            $matricula->setCurso($curso);
            $matricula->setAluno($aluno);
            $matricula->setPorcentagemProgresso(0);
            $matricula->setConcluido(false);
            $matricula->setDataMatricula(new \DateTime());

            MatriculaDAO::salvar($matricula);
            Alert::success("Matricula realizada com sucesso.");

            header('Location: ' . BASE_URL . '/aluno/home');
            exit;

        } catch (\Exception $ex) {
            $erro = $ex->getMessage();

            // Recarrega o catálogo com a mensagem de erro
            $matriculas = MatriculaDAO::listarPorAluno($alunoId);

            $cursosMatriculadosIds = array_map(fn($m) => $m->getCurso()->getId(), $matriculas);

            $cursos = array_filter(
                \dao\CursoDAO::listarPublicados(),
                fn($c) => !in_array($c->getId(), $cursosMatriculadosIds)
            );

            $cursos = array_values($cursos);
            require __DIR__ . '/../view/pages/catalogo-page.php';
        } catch (\Exception $e) {
            $erro = $e->getMessage();
            require __DIR__ . '/../view/pages/error-404.php';
        }
    }

}


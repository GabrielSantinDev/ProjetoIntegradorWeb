<?php

namespace controller;

use dao\CursoDAO;
use model\Curso;
use mysql_xdevapi\Exception;

class CursoController
{

    public function index(): void
    {
        try {
            $cursos = CursoDAO::listar();
            require __DIR__ . '/../view/home-page.php';
        } catch (\Exception $ex) {
            $erro = $ex->getMessage();
            require __DIR__ . '/../view/error-404.php';
        }
    }

    public function novo()
    {
        try {
            $titulo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS));
            $descricao = trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS));
            $categoria = trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS));
            $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
            $horasDuracao = filter_input(INPUT_POST, 'horas_duracao', FILTER_VALIDATE_FLOAT);

            // Validação

            if (empty($titulo) || empty($descricao) || empty($categoria)) {
                throw new Exception(
                    'Todos os campos são obrigatórios.'
                );
            }

            if ($preco === false || $preco < 0) {
                throw new Exception(
                    'Preço inválido.'
                );
            }

            if ($horasDuracao === false || $horasDuracao <= 0) {
                throw new Exception(
                    'Carga horária inválida.'
                );
            }

            $curso = new Curso();

            $curso->setTitulo($titulo);
            $curso->setDescricao($descricao);
            $curso->setCategoria($categoria);
            $curso->setPreco($preco);
            $curso->setHorasDuracao($horasDuracao);
            $curso->setPublicado(false);

            // quando tiver login
            // $curso->setInstrutor($_SESSION['usuario']);

            CursoDAO::salvar($curso);
        } catch (Exception $e) {
            echo "Erro ao salvar curso: " . $e->getMessage();
            exit;
        }

        header('Location: ' . BASE_URL . '/cursos');

        exit;
    }

    public function editar(array $params)
    {
        try {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            $titulo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS));
            $descricao = trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS));
            $categoria = trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS));
            $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
            $horasDuracao = filter_input(INPUT_POST, 'horas_duracao', FILTER_VALIDATE_FLOAT);

            // validações básicas
            if (!$id) {
                throw new \Exception("ID inválido.");
            }

            if (empty($titulo) || empty($descricao) || empty($categoria)) {
                throw new \Exception("Todos os campos são obrigatórios.");
            }

            if ($preco === false || $preco < 0) {
                throw new \Exception("Preço inválido.");
            }

            if ($horasDuracao === false || $horasDuracao <= 0) {
                throw new \Exception("Carga horária inválida.");
            }

            // busca o curso existente
            $curso = CursoDAO::buscarId($id);

            if (!$curso) {
                throw new \Exception("Curso não encontrado.");
            }

            // altera os dados (UPDATE automático do Doctrine)
            $curso->setTitulo($titulo);
            $curso->setDescricao($descricao);
            $curso->setCategoria($categoria);
            $curso->setPreco($preco);
            $curso->setHorasDuracao($horasDuracao);

            // salva (vai virar UPDATE automaticamente)
            CursoDAO::salvar($curso);

            header('Location: ' . BASE_URL . '/cursos');
            exit;

        } catch (\Exception $e) {
            echo "Erro ao editar curso: " . $e->getMessage();
            exit;
        }
    }
    public function remover(array $params)
    {

        try {
            $id = $params['id'];
            $curso = CursoDAO::buscarId($id);

            if (empty($curso)) {
                throw new Exception("Curso não encontrado.");
            }

            CursoDAO::deletar($curso);

        } catch (\Exception $ex) {
            $erro = $ex->getMessage();
            echo "Erro ao deletar curso: " . $erro;
        }

        header('Location: ' . BASE_URL . '/cursos');

    }

    public function togglePublicacao(array $params)
    {
        header('Content-Type: application/json');

        try {
            $id = $_POST['id'] ?? null;

            $curso = CursoDAO::buscarId($id);

            if (!$curso) {
                throw new \Exception("Curso não encontrado");
            }

            // inverte status
            $curso->setPublicado(!$curso->isPublicado());

            CursoDAO::salvar($curso);

            echo json_encode([
                'success' => true,
                'publicado' => $curso->isPublicado()
            ]);
            exit;

        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
}
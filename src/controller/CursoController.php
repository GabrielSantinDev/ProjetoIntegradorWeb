<?php

namespace controller;

use dao\CursoDAO;
use dao\InstrutorDAO;
use Exception;
use model\Curso;
use model\Instrutor;
use service\StorageService;
use utils\Auth;

class CursoController
{

    public function homeInstrutor(): void
    {

        Auth::exigirTipo('instrutor');

        try {
            $cursos = CursoDAO::buscarPorInstrutorId(Auth::getId());
            require __DIR__ . '/../view/pages/home-instrutor.php';
        } catch (\Exception $ex) {
            $erro = $ex->getMessage();
            require __DIR__ . '/../view/pages/error-404.php';
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

            //
            $instrutor = InstrutorDAO::buscarId($_SESSION['usuario']['id']);
            $curso->setInstrutor($instrutor);

            CursoDAO::salvar($curso);

        } catch (Exception $e) {
            echo "Erro ao salvar curso: " . $e->getMessage();
            exit;
        }

        header('Location: ' . BASE_URL . '/instrutor/home');

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

            header('Location: ' . BASE_URL . '/instrutor/home');
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

        header('Location: ' . BASE_URL . '/instrutor/home');

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

    public function atualizarImagem(array $params)
    {
        $uploadService = new StorageService();

        // detect if the request is AJAX / expects JSON
        $isAjax = false;
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $isAjax = true;
        } elseif (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
            $isAjax = true;
        }

        try {
            $id = $params['id'];
            $curso = CursoDAO::buscarId($id);

            if ($curso->getImagemPublicId()) {
                $uploadService->deleteImage($curso->getImagemPublicId());
            }

            $result = $uploadService->uploadImage($_FILES['imagem'], '/php/cursos');

            $curso->setImagemUrl($result['url']);
            $curso->setImagemPublicId($result['public_id']);

            CursoDAO::salvar($curso);

            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'url' => $result['url'],
                    'public_id' => $result['public_id']
                ]);
                exit;
            }

        } catch (\Exception $ex) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
                exit;
            }

            echo "Erro ao salvar imagem: " . $ex->getMessage();
        }

        header('Location: ' . BASE_URL . '/instrutor/home');
    }
}
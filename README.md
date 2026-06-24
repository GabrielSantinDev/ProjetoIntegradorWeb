<div align="center">

<img src="https://img.shields.io/badge/SkillUp-Plataforma%20de%20Cursos-7f22fe?style=for-the-badge&logoColor=white" alt="SkillUp" />

<br/><br/>

![PHP](https://img.shields.io/badge/PHP_8-777BB4?style=flat-square&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap_5-7952B3?style=flat-square&logo=bootstrap&logoColor=white)
![Doctrine](https://img.shields.io/badge/Doctrine_ORM-FC6A31?style=flat-square&logoColor=white)
![FastRoute](https://img.shields.io/badge/FastRoute-Router-gray?style=flat-square)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?style=flat-square&logo=postgresql&logoColor=white)
![Supabase](https://img.shields.io/badge/Supabase-3ECF8E?style=flat-square&logo=supabase&logoColor=white)
![Cloudinary](https://img.shields.io/badge/Cloudinary-3448C5?style=flat-square&logo=cloudinary&logoColor=white)
![PHPUnit](https://img.shields.io/badge/PHPUnit-Testes-6c757d?style=flat-square)
![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow?style=flat-square)

<br/>

**Plataforma de cursos online desenvolvida para a disciplina de Oficina de Desenvolvimento Web — IFPR Sistemas de Informação.**

</div>

---

## 📖 Sobre o Projeto

O **SkillUp** é uma plataforma web de gerenciamento e comercialização de cursos online. O sistema atende dois perfis de usuário: **instrutores**, que criam e administram seus cursos, e **alunos**, que exploram o catálogo, se matriculam e acompanham seu progresso.

O projeto aplica o padrão arquitetural **MVC-DAO** com PHP puro, persistência via **Doctrine ORM**, roteamento com **FastRoute**, interface responsiva com **Bootstrap 5** e armazenamento de imagens no **Cloudinary**. O banco de dados **PostgreSQL** está hospedado na nuvem via **Supabase**.

---

## 🎥 Vídeo de Demonstração

- 📽️ [Apresentação geral](https://drive.google.com/file/d/1l83lf0VSuJMqYEMVThDhYMX1AdCPQKej/view?usp=sharing)

---

## 🎯 Funcionalidades

### 👨‍🎓 Aluno
- Cadastro e login na plataforma *(mínimo 18 anos para instrutores)*
- Visualização dos cursos matriculados com barra de progresso
- Exploração do catálogo de cursos publicados
- Matrícula em cursos disponíveis

### 👨‍🏫 Instrutor
- Cadastro e login na plataforma
- Criação, edição e remoção de cursos
- Upload de imagem de capa via Cloudinary
- Publicação e despublicação de cursos
- Proteção contra remoção de cursos com matrículas ativas

### 🌐 Geral
- Alternância de tema claro/escuro com preferência salva em cookie
- Interface responsiva para diferentes tamanhos de tela (Bootstrap Grid)
- Validação de formulários no cliente com jQuery Validation
- Mensagens de feedback, avisos de erro e confirmações via modal

---

## 🛠 Tecnologias

| Tecnologia | Uso |
|---|---|
| PHP 8 | Linguagem principal do back-end |
| Bootstrap 5 | Interface responsiva e componentes UI |
| Doctrine ORM 3 | Mapeamento objeto-relacional e CRUD |
| FastRoute | Roteamento dinâmico (Front Controller) |
| PostgreSQL via Supabase | Banco de dados em nuvem |
| Cloudinary | Upload e armazenamento de imagens |
| jQuery + jQuery Validation | Interações client-side e validação de formulários |
| PHPUnit | Testes automatizados |
| Composer | Gerenciamento de dependências |
| PHP dotenv | Variáveis de ambiente |

---

## 🏗 Arquitetura

O projeto segue o padrão **MVC-DAO**, com separação clara de responsabilidades entre as camadas:

```
ProjetoIntegradorWeb/
│
├── public/                      # Ponto de entrada público
│   ├── index.php                # Front Controller + roteamento FastRoute
│   ├── .htaccess                # Redirecionamento Apache
│   └── assets/
│       ├── css/
│       │   └── style.css
│       └── js/
│           ├── main.js          # Tema, toggle de senha
│           └── modal-curso.js   # AJAX: modal, publicação, upload de imagem
│
├── src/
│   ├── controller/              # Recebem requisições e orquestram a resposta
│   │   ├── AlunoController.php
│   │   ├── CursoController.php
│   │   └── UsuarioController.php
│   │
│   ├── dao/                     # Acesso ao banco via Doctrine EntityManager
│   │   ├── GenericDAO.php       # CRUD genérico (Template Method)
│   │   ├── AlunoDAO.php
│   │   ├── AvaliacaoDAO.php
│   │   ├── CursoDAO.php
│   │   ├── InstrutorDAO.php
│   │   ├── MatriculaDAO.php
│   │   └── GenericDAO.php
│   │
│   ├── model/                   # Entidades Doctrine (mapeadas via atributos PHP 8)
│   │   ├── GenericModel.php     # ID auto-gerado (MappedSuperclass)
│   │   ├── Usuario.php          # Superclasse abstrata (MappedSuperclass)
│   │   ├── Aluno.php
│   │   ├── Instrutor.php
│   │   ├── Curso.php
│   │   ├── Matricula.php
│   │   └── Avaliacao.php
│   │
│   ├── service/
│   │   └── StorageService.php   # Upload/delete de imagens no Cloudinary
│   │
│   ├── utils/
│   │   ├── Auth.php             # Façade: sessão, autenticação e autorização
│   │   └── Conexao.php          # EntityManager do Doctrine
│   │
│   └── view/
│       ├── pages/               # Páginas principais
│       │   ├── login-page.php
│       │   ├── cadastro-page.php
│       │   ├── home-instrutor.php
│       │   ├── home-aluno.php
│       │   ├── catalogo-page.php
│       │   └── error-404.php
│       └── components/          # Componentes reutilizáveis
│       └── templates/           # Footer, head e navbar
├── test/                        # Testes com PHPUnit
│   └── dao/
├── vendor/                      # Dependências do Composer
├── doctrine.php                 # CLI do Doctrine (schema-tool)
├── composer.json
├── .env                         # Variáveis de ambiente (não versionado)
└── README.md
```

### Padrões de Projeto Aplicados

| Padrão | Onde | Descrição |
|---|---|---|
| **Template Method** | `GenericDAO` | Define o esqueleto dos métodos CRUD; subclasses informam apenas a entidade alvo via `$modelClass` |
| **Façade** | `Auth` | Interface unificada para sessão, autenticação, autorização e redirecionamento |
| **Factory Method** | `UsuarioFactory` | Decide qual classe instanciar (`Aluno` ou `Instrutor`) com base no tipo informado no cadastro |
| **Front Controller** | `public/index.php` | Centraliza todas as requisições e despacha para o controller correto via FastRoute |

---

## 🔐 Autenticação e Sessões

A autenticação utiliza **sessões PHP** com a classe `Auth` centralizando toda a lógica:

```
1. Usuário informa email e senha no formulário de login
2. UsuarioController busca nas tabelas tb_instrutor e tb_aluno
3. password_verify() valida a senha (BCrypt)
4. Auth::login() salva id, nome e tipo na $_SESSION
5. Preferência de tema salva em cookie do navegador
6. Auth::exigirTipo() protege rotas por perfil de acesso
```

---

## ▶️ Como Executar

### Pré-requisitos

- PHP 8+
- Composer
- Apache com mod_rewrite ativo (XAMPP recomendado)
- Conta no [Supabase](https://supabase.com) (PostgreSQL)
- Conta no [Cloudinary](https://cloudinary.com)

### 1. Clonar o repositório

```bash
git clone https://github.com/GabrielSantinDev/ProjetoIntegradorWeb.git
cd ProjetoIntegradorWeb
```

### 2. Instalar dependências

```bash
composer install
```

### 3. Configurar o `.env`

```env
DB_HOST=<host-supabase>
DB_PORT=5432
DB_NAME=<nome-do-banco>
DB_USER=<usuario>
DB_PASSWORD=<senha>

CLOUDINARY_CLOUD_NAME=<cloud-name>
CLOUDINARY_API_KEY=<api-key>
CLOUDINARY_API_SECRET=<api-secret>
```

### 4. Criar o schema no banco

```bash
php doctrine.php orm:schema-tool:update --force
```

### 5. Configurar o Apache

Aponte o `DocumentRoot` do Apache para a pasta `public/` do projeto. O `.htaccess` já redireciona todas as requisições para o `index.php`.

A aplicação estará disponível em `http://localhost/ProjetoIntegradorWeb`.

---

## 🧪 Testes

```bash
./vendor/bin/phpunit
```

---

## 🔗 Projetos Relacionados

| Repositório | Descrição | Tecnologia |
|---|---|---|
| [ProjetoIntegrador](https://github.com/GabrielSantinDev/ProjetoIntegrador) | API REST do mesmo sistema | Java + Spring Boot |
| [projeto-integrador-react](https://github.com/GabrielSantinDev/projeto-integrador-react) | Front-end que consome a API REST | React + TailwindCSS |
| [ProjetoIntegradorWeb](https://github.com/GabrielSantinDev/ProjetoIntegradorWeb) | **Este repositório** — versão web | PHP + Bootstrap |

---

## 👥 Equipe

Projeto desenvolvido para a disciplina de **Oficina de Desenvolvimento Web** do curso de **Sistemas de Informação — IFPR Campus Palmas**.

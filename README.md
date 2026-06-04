# Projeto Integrador - Oficina de Desenvolvimento Web

![PHP](https://img.shields.io/badge/PHP-8-blue)
![Doctrine](https://img.shields.io/badge/Doctrine-ORM-orange)
![Composer](https://img.shields.io/badge/Composer-Depend%C3%AAncias-brown)
![PHPUnit](https://img.shields.io/badge/PHPUnit-Testes-green)
![MySQL](https://img.shields.io/badge/MySQL-Banco-informational)
![XAMPP](https://img.shields.io/badge/XAMPP-Ambiente-red)
![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow)

Projeto desenvolvido para a disciplina de **Oficina de Desenvolvimento Web**, com o objetivo de aplicar conceitos de **modelagem de entidades**, **persistência de dados**, **operações CRUD** e **organização de um sistema web em PHP**.

O sistema foi desenvolvido em ambiente local utilizando **XAMPP (Apache/MySQL)**, com estrutura organizada em pastas e uso de **Doctrine ORM** para o mapeamento das classes.

---

## 📌 Objetivo

Este projeto tem como finalidade desenvolver a base estrutural de um sistema web, aplicando os conceitos estudados em aula, como:

- organização de projeto em camadas;
- criação de entidades (Models);
- persistência de dados em banco relacional;
- implementação de operações CRUD;
- testes das funcionalidades principais.

---

## 🛠️ Tecnologias Utilizadas

- **PHP Storm IDE**
- **PHP 8**
- **Composer**
- **Doctrine ORM**
- **PHPUnit**
- **MySQL / MariaDB**
- **XAMPP**
- **Apache**

---

## 📂 Estrutura do Projeto

O projeto foi organizado em pastas, seguindo a estrutura trabalhada em aula:

```bash
ProjetoIntegradorWeb/
│
├── src/
│   ├── dao/          # Camada de acesso a dados
│   ├── model/        # Classes de entidade (Models)
│   └── util/         # Configurações e conexão com o banco
│
├── test/
│   ├── dao/          # Testes unitários / integração
│   └── util/         # Teste de Conexão com o banco
│
├── vendor/           # Dependências instaladas pelo Composer
├── composer.json
├── composer.lock
├── .env              # Dados para conexão com o Banco de Dados
└── README.md

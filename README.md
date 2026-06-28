# 🐾 AdotaPet CCO

**Plataforma Centralizada para Adoção de Animais e Apoio a ONGs Locais**

> Projeto desenvolvido como parte da Prática Extensionista III — UNOESC Chapecó
> Curso de Análise e Desenvolvimento de Sistemas

---

## 📋 Sobre o Projeto

O AdotaPet CCO é uma plataforma web desenvolvida para conectar ONGs de proteção animal de Chapecó (SC) a potenciais adotantes, centralizando em um único ambiente os animais disponíveis para adoção na cidade.

O problema que motivou o projeto é real: as ONGs locais divulgam seus animais de forma fragmentada, redes sociais, grupos de WhatsApp, feiras eventuais, o que reduz o alcance das campanhas e dificulta o processo para quem quer adotar. O AdotaPet CCO resolve isso reunindo tudo em um só lugar, com uma interface clara, filtros de busca e integração com PIX para doações diretas às organizações.

---

## 🎯 Funcionalidades Principais

- Cadastro de perfis para **Adotantes** e **ONGs/Protetores**
- Aprovação de ONGs pelo administrador da plataforma
- Cadastro de animais com foto, espécie, porte, sexo, idade e descrição
- Listagem de animais disponíveis com **filtros reativos** (sem recarregamento de página)
- Perfil completo do animal com dados da ONG responsável
- Solicitação de adoção com redirecionamento para contato via WhatsApp ou e-mail
- Exibição de **chave PIX** da ONG para doações diretas
- Painel da ONG para gerenciar animais e avaliar solicitações de adoção

---

## 🛠️ Stack Tecnológica

| Camada | Tecnologia |
|--------|-----------|
| Back-end | Laravel 11 + PHP 8.3 |
| Front-end | Laravel Blade + Livewire 3 + TailwindCSS |
| Banco de dados | MySQL 8 |
| Autenticação | Laravel Breeze + Sanctum |
| Armazenamento | Laravel Storage + S3 |
| Infraestrutura | Docker + Git + CI/CD |

---

## 👥 Atores do Sistema

- **Adotante** — busca, filtra e solicita adoção de animais
- **ONG / Protetor** — cadastra animais e avalia solicitações de adoção
- **Administrador** — aprova cadastros de ONGs e gerencia usuários

---

## 📁 Estrutura do Repositório

```
adotapet/
├── documentacao/
│   ├── er_conceitual.jpg
│   ├── er_logico.jpg
│   ├── diagrama_classes.jpg
│   ├── caso_de_uso.jpg
│   ├── sequencia_1_autenticacao.png
│   ├── sequencia_2_busca.png
│   ├── sequencia_3_adocao.png
│   ├── atividades_1_adotante.jpg
│   ├── atividades_2_ong.jpg
│   └── AdotaPet_CCO_PE3_Relatorio.docx
└── README.md
```

---

## 📐 Modelagem do Sistema

A documentação técnica completa está disponível na pasta [`/documentacao`](./documentacao), incluindo:

- **ER Conceitual** — entidades, relacionamentos e cardinalidades (notação Chen)
- **ER Lógico** — tabelas, tipos de dados e chaves em notação crow's foot
- **Diagrama de Classes** — classes, atributos, métodos e enumerações
- **Diagrama de Caso de Uso** — 3 atores e 15 casos de uso com include/extend
- **Diagramas de Sequência** — 3 fluxos: autenticação, busca e adoção
- **Diagramas de Atividades** — 2 fluxos com swim lanes: adotante e ONG

---

## 👨‍💻 Desenvolvedor

**Bruno Sisterhenn Putzel**
Curso de Análise e Desenvolvimento de Sistemas — UNOESC Chapecó
Prática Extensionista III — 2026

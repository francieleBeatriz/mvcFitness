# 🏋️‍♂️ Fitness APP

Uma aplicação web para gerenciamento de desafios fitness e acompanhamento de progresso pessoal.

## 📋 Sobre o Projeto

O Fitness APP é uma aplicação web desenvolvida em PHP que permite aos usuários gerenciar seus desafios fitness e acompanhar seu progresso. Os usuários podem criar uma conta, definir desafios personalizados e registrar seu progresso ao longo do tempo.

## 🚀 Funcionalidades

- ✅ Sistema de autenticação (login/cadastro)
- 📝 Criação e gerenciamento de desafios personalizados
- 📊 Acompanhamento de progresso
- 👤 Perfil de usuário
- 🔒 Sistema seguro de senhas com hash

## 🛠️ Tecnologias Utilizadas

- PHP 8.2
- MySQL/MariaDB
- HTML/CSS
- Apache Server

## 🗄️ Estrutura do Banco de Dados

O projeto utiliza três tabelas principais:

1. `usuarios` - Armazena informações dos usuários
   - id (PK)
   - nome
   - email (único)
   - senha (hash)

2. `desafios` - Armazena os desafios criados
   - id (PK)
   - nome
   - descricao
   - usuario_id (FK)

3. `progresso` - Registra o progresso dos usuários
   - id (PK)
   - usuario_id (FK)
   - desafio_id (FK)
   - progresso

## 🔧 Instalação

1. Clone o repositório
2. Importe o arquivo `fitness.sql` para seu servidor MySQL/MariaDB
3. Configure seu servidor web (Apache) para apontar para o diretório do projeto
4. Certifique-se de que o PHP 8.2 ou superior está instalado
5. Configure as credenciais do banco de dados no arquivo de configuração

## 📁 Estrutura do Projeto

```
├── controller/     # Controladores da aplicação
├── dao/           # Camada de acesso a dados
├── generic/       # Classes genéricas e utilitárias
├── public/        # Arquivos públicos (CSS, JS, imagens)
├── service/       # Camada de serviços
├── views/         # Templates e arquivos de visualização
├── .htaccess     # Configurações do Apache
├── index.php     # Ponto de entrada da aplicação
└── fitness.sql   # Script de criação do banco de dados
```

## 🔐 Rotas Principais

- `/login` - Página de login
- `/cadastrar` - Página de cadastro
- `/home` - Dashboard principal
- `/home/cadastrar` - Criar novo desafio
- `/home/editar` - Editar desafio existente
- `/home/progressos` - Visualizar progressos
- `/perfil` - Gerenciar perfil


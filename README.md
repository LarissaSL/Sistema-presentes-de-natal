# 🎄 Sistema Gerenciador de Presentes de Natal

## 📝 Descrição do Projeto

O **Sistema Gerenciador de Presentes de Natal** é uma aplicação web projetada para ajudar os usuários a gerenciar os presentes que desejam dar aos seus contatos durante as festas de fim de ano. O usuário pode se cadastrar e gerenciar seus contatos, adicionar presentes para cada um deles e manter todas as informações organizadas em um único lugar. O sistema oferece uma interface simples e intuitiva para facilitar o acompanhamento dos presentes e das interações com os contatos.

---

## ⚙️ Instruções de Instalação e Execução

### 1. Clone o Repositório

Clone este repositório para a sua máquina local utilizando o comando:

```bash
git clone <URL-do-repositório>
```

### 2. Suba o Container com Docker

Após clonar o repositório, navegue até o diretório do projeto e execute o comando abaixo para construir o container Docker:

```bash
docker-compose build
```

### 3. Suba os Containers em Background

Para subir os containers em segundo plano, execute:

```bash
docker-compose up -d
```

### 4. Acesse o Bash do Container

Entre no bash do container para configurar e atualizar as dependências do projeto:

```bash
docker-compose exec app bash
```

### 5. Atualize as Dependências com o Composer

Dentro do bash do container, execute o seguinte comando para atualizar as dependências do PHP:

```bash
composer update
```

---

## 🛠️ Configurações do Projeto

### 🌐 Portas do Projeto

- **Porta 8080**: Acessar o PHPMyAdmin (interface de administração do banco de dados) 🖥️
- **Porta 9000**: Acessar a aplicação web (APP) 🌍

### 🔑 Credenciais do PHPMyAdmin

- **Usuário**: `root`
- **Senha**: `admin`
- **Nome do Banco de Dados**: `crud`

---

## 🔧 Personalização

Se desejar alterar as configurações do banco de dados ou as portas de acesso, basta editar os arquivos:

- `.env` 📝
- `docker-compose.yml` ⚙️

---

## ⚠️ Observações

- O projeto está configurado para rodar em containers Docker 🐳, proporcionando um ambiente isolado e fácil de configurar.
- Após seguir as etapas de instalação, o sistema estará pronto para ser acessado nas portas configuradas.


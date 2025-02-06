# Aplicação de Gestão de Pedidos de Materiais

Esta é uma aplicação para gestão de pedidos de materiais, desenvolvida para facilitar o processo de solicitação, aprovação e acompanhamento de pedidos em um ambiente corporativo. A aplicação inclui funcionalidades como autenticação de usuários, criação de pedidos, aprovação/reprovação de pedidos, envio de notificações por e-mail e execução de comandos agendados.

---

## 🚀 Como Executar o Projeto

Siga os passos abaixo para configurar e executar a aplicação em seu ambiente local.

### **Pré-requisitos**

- Node.js (v18 ou superior)
- npm (v9 ou superior)
- Banco de dados (MySQL)
- Servidor de e-mail (ex: SMTP, Mailtrap, Amazon SES)

---

### **Passos para Configuração**

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/ivandroJ/gestor-pedidos.git
   cd gestor-pedidos
   ```

2. **Instale as dependências**:
   ```bash
   npm install
   ```

3. **Configure o ambiente**:
   - Crie um arquivo `.env` na raiz do projeto com base no arquivo `.env.example`.
   - Preencha as variáveis de ambiente, como credenciais do banco de dados, chaves de API e configurações de e-mail.

   Exemplo de `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestao_pedidos
   DB_USERNAME=root
   DB_PASSWORD=

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=seu-usuario
   MAIL_PASSWORD=sua-senha
   MAIL_FROM_ADDRESS=no-reply@gestaopedidos.com
   MAIL_FROM_NAME="Gestão de Pedidos"
   ```

---

## 📧 Configuração do Envio de E-mails

A aplicação utiliza o **Nodemailer** para envio de e-mails. Certifique-se de configurar corretamente as variáveis de ambiente relacionadas ao e-mail no arquivo `.env`.

- **Mailtrap** (para ambiente de desenvolvimento):
  - Use as credenciais fornecidas pelo Mailtrap para configurar `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME` e `MAIL_PASSWORD`.

- **SMTP** (para produção):
  - Configure com as credenciais do seu provedor de e-mail (ex: Gmail, Amazon SES, SendGrid).


---

## 🛠️ Comandos Úteis


- **Rodar em modo de desenvolvimento**:
  ```bash
  composer run dev
  ```

---

## ✉️ Contato

Para dúvidas ou sugestões, entre em contato:

- **E-mail**: ivandroscar@gmail.com

---

**Nota**: Certifique-se de executar `npm install` e `npm run build` após clonar o repositório para garantir que todas as dependências e assets estejam corretamente instalados e compilados.

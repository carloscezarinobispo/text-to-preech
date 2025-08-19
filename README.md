# Projeto Text to Speech com Laravel

Este é um projeto simples em Laravel que converte texto em áudio utilizando a API de Text-to-Speech (TTS) da [ElevenLabs](https://elevenlabs.io/).

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação do servidor.
- **Laravel**: Framework para desenvolvimento de aplicações web.
- **Composer**: Gerenciador de dependências do PHP.
- **ElevenLabs API**: Serviço externo para a síntese de voz.

## Requisitos

Para executar o projeto, você precisa ter os seguintes itens instalados em seu ambiente:

- PHP 8.0 ou superior
- Composer
- Uma conta e chave de API válida da ElevenLabs
- O ID de uma voz disponível em sua conta ElevenLabs

## Instalação

Siga os passos abaixo para preparar e executar o projeto:

1. **Clone o repositório do projeto**
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   cd seu-repositorio
   ```

2. **Instale as dependências do Composer**
   ```bash
   composer install
   ```

3. **Configure o arquivo de ambiente da aplicação**
   - Copie o arquivo `.env.example` para `.env`:
     ```bash
     cp .env.example .env
     ```
   - Gere a chave da aplicação:
     ```bash
     php artisan key:generate
     ```

## Configuração da API ElevenLabs

Abra o arquivo `app/Http/Controllers/AudioController.php` e localize o método `convert()`. Substitua os valores de exemplo pelas suas informações da ElevenLabs:

```php
// Substitua 'SUA_CHAVE_AQUI' pela sua chave de API real da ElevenLabs
$apiKey = 'SUA_CHAVE_AQUI'; 

// Substitua 'SEU_ID_DE_VOZ_AQUI' pelo ID da voz que você deseja usar
$voiceId = 'SEU_ID_DE_VOZ_AQUI';
```

## Execução

1. **Inicie o servidor de desenvolvimento do Laravel**
   ```bash
   php artisan serve
   ```

2. **Acesse a aplicação no seu navegador**
   - URL padrão: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Estrutura do Projeto

- **routes/web.php**: Define as rotas que conectam as URLs com a lógica da aplicação.
- **app/Http/Controllers/AudioController.php**: Contém o código responsável por processar a requisição e interagir com a API da ElevenLabs.
- **resources/views/index.blade.php**: Exibe o formulário de entrada de texto para o usuário.

## Contribuição

Sinta-se à vontade para abrir issues ou enviar pull requests com melhorias e correções.

---

**Licença:** Este projeto está sob a licença MIT.

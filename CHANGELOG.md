# Changelog

Todas as alterações relevantes do projeto LivroNet serão registradas neste arquivo.

---

## v0.2.0 - 2026-06-07

### Flutter

- Refatoração do ApiService para Singleton.
- Criação de AppMessages para centralização de mensagens.
- Criação de ApiException para tratamento padronizado de erros.
- Atualização dos Providers para utilização do novo padrão de exceções.
- Inclusão de placeholders padrão para capas de livros.

### Laravel

- Conclusão da migração de school_grade para grade_id.
- Inclusão de filtro por grade_id no endpoint de livros.
- Criação de índices para melhoria de desempenho na tabela books.
- Ativação de preventLazyLoading para detecção de consultas ineficientes.
- Ajustes no BookResource para refletir a nova estrutura de séries.

### Correções

- Ajustes na exibição de séries escolares.
- Correções de tratamento de erros entre Flutter e Laravel.
- Melhorias gerais de desempenho e organização da arquitetura.

### Próximas etapas

- Perfil do usuário.
- Filtros avançados.
- Infinite Scroll.
- Upload de imagens.
- Disclaimer de segurança.
- Recuperação de senha.
- Confirmação de e-mail.

---

## v0.3.0 - 2026-06-11

### Flutter

- Implementação da tela de Perfil do Usuário utilizando Providers dedicados.
- Inclusão da hierarquia Estado → Cidade → Escola na edição de perfil.
- Criação de StateProvider e StateRepository.
- Criação de ProfileProvider e ProfileRepository.
- Correção do carregamento excessivo de cidades na tela de perfil.
- Inclusão da funcionalidade de exclusão de livros em "Meus Livros".
- Criação do componente reutilizável BookCard.
- Implementação do sistema de filtros avançados de livros.
- Criação do modelo BookFilter.
- Implementação de filtros por:
    - Estado
    - Cidade
    - Escola
    - Disciplina
    - Série
    - Venda
    - Troca
    - Doação

- Integração dos filtros com paginação.
- Inclusão de tela dedicada para filtros de livros.
- Inclusão de botão de filtros na AppBar principal.
- Melhorias de UX na tela de filtros com destaque para a ação principal "Aplicar Filtros".

### Laravel

- Inclusão de filtro por state_id no endpoint de listagem de livros.
- Otimização das consultas relacionadas à localização dos usuários.
- Ajustes para suportar filtros avançados combinados.

### Correções

- Correção da atualização de perfil com seleção de Estado, Cidade e Escola.
- Correção do comportamento de cidades dependentes do estado selecionado.
- Correção do tratamento de escolas duplicadas durante o cadastro.
- Tratamento apropriado de respostas HTTP 409 (Conflict).
- Exibição de mensagens amigáveis para escolas já cadastradas.
- Correções diversas na navegação entre telas de livros e perfil.

### Melhorias de Desempenho

- Redução de carregamentos desnecessários de cidades.
- Reutilização de filtros ativos durante paginação.
- Melhor organização da arquitetura Provider/Repository.
- Redução de consultas redundantes em fluxos de perfil e filtros.

### Backlog Registrado

- Edição de livros.
- Sistema de favoritos.
- Persistência dos filtros ao reabrir a tela de filtros.
- Chips de filtros ativos na listagem de livros.
- Cadastro de escolas diretamente pela tela de perfil.
- Seleção automática de escola existente ao detectar duplicidade.
- Busca textual por título, autor e editora.
- Ordenação por preço e data de publicação.

---

## v0.3.1 - 2026-06-11

### Flutter

- Implementação da edição de livros utilizando a mesma tela de cadastro.
- Inclusão de updateBook() no Repository e Provider.
- Preenchimento automático de disciplina e série durante a edição.
- Atualização automática da lista após edição.
- Evolução do BookModel para suportar GradeModel completo.
- Correção da exibição da série nos cards de livros.

### Correções

- Correção da exibição "Instance of GradeModel".
- Ajustes de compatibilidade entre cadastro e edição de livros.

---

## v0.4.0 - 2026-06-12

### Flutter

#### Favoritos

- Implementação da tela de Favoritos.
- Criação de FavoriteProvider.
- Criação de FavoriteRepository.
- Navegação para Favoritos pela AppBar principal.
- Atualização automática do estado dos favoritos entre telas.
- Sincronização da lista de favoritos após inclusão e remoção.

#### Interface e Branding

- Alteração do nome do aplicativo para LivroNet.
- Inclusão do logotipo oficial do projeto.
- Geração dos ícones Android.
- Geração dos ícones iOS.
- Inclusão dos assets de identidade visual.
- Preparação da estrutura para Splash Screen.

### Laravel

#### Sistema de Favoritos

- Criação da tabela favorites.
- Implementação do relacionamento User ↔ Book para favoritos.
- Criação do FavoriteController.
- Endpoint para favoritar livros.
- Endpoint para remover favoritos.
- Endpoint para listar favoritos do usuário autenticado.
- Inclusão do campo is_favorite na API de livros.
- Inclusão do carregamento do relacionamento favoritedBy.

#### Segurança

- Proteção dos endpoints de livros com autenticação Sanctum.
- Padronização do acesso autenticado aos recursos do sistema.

### Correções

#### Favoritos

- Correção da identificação de favoritos na listagem geral de livros.
- Correção da sincronização entre os endpoints /books e /favorites.
- Correção da atualização visual dos favoritos após navegação entre telas.
- Correção da identificação do usuário autenticado nos recursos BookResource.

#### Arquitetura

- Ajustes no carregamento de relacionamentos para evitar inconsistências de favoritos.
- Melhor organização dos Providers relacionados à navegação principal.

### Backlog Atualizado

#### Alta Prioridade

- Sistema de mensagens entre usuários.
- Splash Screen.
- Disclaimer inicial de uso e segurança.
- Upload de imagens dos livros.

#### Média Prioridade

- Recuperação de senha.
- Confirmação de e-mail.
- Persistência dos filtros ao reabrir a tela.
- Chips de filtros ativos.
- Busca textual por título, autor e editora.
- Ordenação por preço e data.

#### Evoluções Futuras

- Infinite Scroll.
- Notificações.
- Denúncia de usuários.
- Bloqueio de usuários.
- Histórico de conversas.
- Avaliação de usuários.

## v0.5.0 - 2026-06-18

### Flutter

#### Splash Screen e Onboarding

- Implementação da Splash Screen do LivroNet.
- Inclusão da identidade visual do aplicativo na inicialização.
- Implementação da tela de Disclaimer.
- Persistência local do aceite do Disclaimer.
- Integração do fluxo Splash → Disclaimer → Login.

#### Arquitetura

- Criação do AppConfig.
- Criação do AppColors.
- Criação do AppTheme.
- Organização da estrutura de configuração e temas do aplicativo.

#### Mensagens

- Criação dos modelos ConversationModel e MessageModel.
- Criação do MessageProvider.
- Criação do MessageRepository.
- Implementação inicial das telas de conversas e chat.
- Preparação da arquitetura para o módulo de mensagens.

#### Branding

- Atualização dos assets do aplicativo.
- Ajustes de identidade visual Android.
- Ajustes de identidade visual iOS.

---

## v0.6.0 - 2026-06-18

### Verificação de E-mail

- Implementação do fluxo de confirmação de e-mail.
- Integração com backend Laravel.
- Implementação do endpoint de reenvio de confirmação.
- Controle de acesso baseado em e-mail verificado.

### Recuperação de Senha

- Implementação do fluxo "Esqueci minha senha".
- Integração com recuperação de senha do Laravel.
- Implementação da tela ForgotPasswordScreen.

### Interface

- Criação da tela EmailVerificationPendingScreen.
- Exibição do e-mail cadastrado para confirmação.
- Inclusão de componentes reutilizáveis:
    - SuccessDialog
    - ErrorDialog
    - InfoDialog

### Segurança

- Bloqueio de acesso para usuários sem e-mail confirmado.
- Validação de sessão através do endpoint /me.
- Tratamento de sessões inválidas.
- Tratamento de usuários removidos do banco de dados.
- Logout resiliente em caso de token inválido.

### Correções

- Correções de navegação entre Login, Home e Verificação de E-mail.
- Correções no fluxo de autenticação.
- Correções no fluxo de recuperação de senha.
- Correções de responsividade da tela de confirmação de e-mail.

### Melhorias de UX

- Exibição do e-mail cadastrado na tela de confirmação pendente.
- Reenvio de e-mail de confirmação diretamente pelo aplicativo.
- Mensagens de sucesso e erro padronizadas.

### Backlog Atualizado

#### Alta Prioridade

- Favoritar livro diretamente na tela de detalhes.
- Abrir filtros já preenchidos com estado e cidade do usuário.
- Incluir opção "Todas" na lista de escolas.
- Exibir e-mail do anunciante na tela de detalhes do livro.

#### Média Prioridade

- Perfil com e-mail somente leitura.
- Correção dos avisos use_build_context_synchronously.
- Status de conta (ativa, suspensa e bloqueada).

#### Evoluções Futuras

- Sistema completo de mensagens.
- Painel administrativo Laravel.
- Moderação de conteúdo.
- Notificações.
- Avaliação de usuários.
- Histórico de conversas.

## v0.7.0 - 2026-06-20

### LIV-080 - Sistema de Mensagens

- Implementação da entidade Conversation.
- Refatoração completa do módulo de mensagens.
- Criação do ConversationController.
- Refatoração do MessageController.
- Implementação da arquitetura Conversation -> Messages.
- Atualização do MessageProvider.
- Atualização do MessageRepository.
- Refatoração do ChatScreen.
- Refatoração do MessagesScreen.
- Integração da tela de detalhes do livro com conversas.
- Validação completa do fluxo de mensagens ponta a ponta.

### LIV-081 - Instituições de Ensino

- Criação da MilitarySchoolsSeeder.
- Inclusão dos Colégios Militares do Sistema Colégio Militar do Brasil.
- Criação da FederalInstitutesSeeder.
- Inclusão dos Institutos Federais do Brasil.
- Implementação de seeders idempotentes utilizando updateOrCreate().
- Padronização dos tipos de instituições de ensino.

### Backlog Atualizado

- LIV-090 ISBN Automático.
- Layout avançado do módulo de mensagens.
- Exclusão de conversas.
- Indicador visual de leitura.
- Upload de imagens dos livros.

---

## Próxima Sprint Planejada

### LIV-090 - ISBN Automático

Backend

Concluído.

Endpoint disponível:

GET /api/books/isbn/{isbn}

Arquitetura:

IsbnController
→ BookMetadataService
→ OpenLibraryService
→ GoogleBooksService (fallback)

Dados retornados:

- ISBN
- Título
- Autor
- Editora
- Data de publicação
- Capa
- Fonte da consulta

Flutter (Planejado)

- IsbnLookupModel
- IsbnRepository
- IsbnProvider
- Integração CreateBookScreen
- Preenchimento automático dos campos do livro
- Preview da capa

Próxima evolução:

### LIV-090.1

Leitura de ISBN por câmera

Tecnologia prevista:

- mobile_scanner

Objetivo:

- Capturar ISBN via câmera
- Consultar metadados automaticamente
- Reduzir tempo de cadastro

## v0.8.0-beta1 - 2026-06-23

### LIV-090 - ISBN Lookup

#### Flutter

- Criação do IsbnLookupModel.
- Criação do IsbnRepository.
- Criação do IsbnProvider.
- Integração da consulta ISBN na tela de cadastro de livros.
- Implementação da leitura de ISBN por câmera utilizando mobile_scanner.
- Preenchimento automático de:
    - ISBN
    - Título
    - Autor
    - Editora
    - Data de publicação
    - Capa

#### Laravel

- Implementação do endpoint GET /api/books/isbn/{isbn}.
- Criação do IsbnController.
- Criação do BookMetadataService.
- Integração com OpenLibrary.
- Integração com Google Books como fallback.
- Inclusão de logs detalhados para auditoria das consultas ISBN.

### LIV-091 - ISBN Catalog

#### Laravel

- Criação da tabela isbn_catalog.
- Criação do model IsbnCatalog.
- Persistência local dos metadados obtidos nas APIs externas.
- Reutilização automática de consultas previamente realizadas.
- Controle de:
    - lookup_count
    - last_lookup_at
    - last_api_refresh_at
    - source
    - api_response_hash
    - subjects sugeridos

#### Benefícios

- Redução de chamadas para APIs externas.
- Redução de tempo de resposta.
- Menor dependência de serviços externos.
- Base para classificação automática de disciplinas.

### LIV-094 - Cover Cache

#### Laravel

- Download automático das capas retornadas pelas APIs ISBN.
- Armazenamento local das capas no servidor.
- Reutilização automática das capas já armazenadas.
- Inclusão do campo local_cover_path.
- Implementação de logs para download e reaproveitamento de capas.

### LIV-096 - Scanner Stabilization

#### Flutter

- Correção de incompatibilidades do plugin mobile_scanner.
- Ajustes de permissões Android.
- Correção de falhas na inicialização do scanner.
- Estabilização da leitura por câmera.

### LIV-097A - Exibição de Capas

#### Flutter

- Exibição de capas reais na listagem de livros.
- Exibição de capas reais na tela de detalhes.
- Fallback para placeholder quando não houver imagem.

#### Infraestrutura

- Correção da publicação do storage na Hostinger.
- Criação manual do link simbólico:

    public/storage -> ../storage/app/public

#### Resultado

- Capas ISBN exibidas corretamente.
- Capas personalizadas exibidas corretamente.

### LIV-102 - Exibição de ISBN

#### Flutter

- Inclusão do ISBN na tela de detalhes do livro.
- Exibição condicional apenas quando o ISBN estiver preenchido.

### Backlog Registrado

- LIV-097B - Capas em Favoritos e Meus Livros.
- LIV-098 - Shared Cover Storage.
- LIV-099 - ISBN First Workflow.
- LIV-100 - Limpeza do formulário após consulta ISBN.
- LIV-101 - Estratégia avançada de retry para APIs ISBN.
- LIV-102A - Copiar ISBN para área de transferência.
- LIV-103 - Book Compact Card.

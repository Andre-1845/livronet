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

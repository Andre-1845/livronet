# Changelog

Todas as alterações relevantes do projeto LivroNet serão registradas neste arquivo.

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
- Otimização das consultas relacionadas a localização dos usuários.
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

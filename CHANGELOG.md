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

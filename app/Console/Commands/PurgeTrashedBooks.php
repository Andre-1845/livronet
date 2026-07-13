<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PurgeTrashedBooks extends Command
{
    /**
     * Sem painel admin ainda, este comando é o jeito de manter o banco
     * limpo: livros que foram soft-deletados há mais de X dias são
     * removidos definitivamente (registro + imagem no storage).
     *
     * Rodar manualmente quando quiser, ou agendar (ver App\Console\Kernel /
     * bootstrap/app.php withSchedule) para rodar mensalmente, por exemplo.
     *
     * Uso:
     *   php artisan books:purge-trashed             (usa 90 dias por padrão)
     *   php artisan books:purge-trashed --days=30
     *   php artisan books:purge-trashed --dry-run    (só mostra o que seria apagado)
     */
    protected $signature = 'books:purge-trashed
        {--days=90 : Quantos dias desde a exclusão para considerar elegível}
        {--dry-run : Apenas lista o que seria apagado, sem apagar de fato}';

    protected $description = 'Remove definitivamente livros soft-deletados há mais de N dias (registro + imagem).';

    public function handle(): int
    {
        $days = (int) $this->option('days');

        $query = Book::onlyTrashed()
            ->where('deleted_at', '<=', now()->subDays($days));

        $count = $query->count();

        if ($count === 0) {
            $this->info("Nenhum livro elegível para limpeza (mais de {$days} dias na lixeira).");

            return self::SUCCESS;
        }

        if ($this->option('dry-run')) {
            $this->info("{$count} livro(s) seriam removidos definitivamente (--dry-run, nada foi apagado):");

            $query->get(['id', 'title', 'deleted_at'])->each(
                fn ($book) => $this->line(" - #{$book->id} \"{$book->title}\" (apagado em {$book->deleted_at})")
            );

            return self::SUCCESS;
        }

        $removed = 0;

        $query->get()->each(function (Book $book) use (&$removed) {

            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            $book->forceDelete();

            $removed++;
        });

        $this->info("{$removed} livro(s) removidos definitivamente.");

        return self::SUCCESS;
    }
}

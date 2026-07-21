<?php

namespace App\Providers;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmailMail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(
            ! app()->isProduction()
        );

        $this->useBrandedAuthEmails();

        $this->configureRateLimiting();
    }

    /**
     * Limite padrao pra toda a API (rotas de auth ja tem throttle mais
     * apertado especifico em routes/api.php -- isso aqui cobre o resto,
     * que hoje nao tinha limite nenhum). Aplicado via
     * bootstrap/app.php -> $middleware->throttleApi().
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip()
            );
        });
    }

    /**
     * Troca o tema padrao (em ingles) dos e-mails automaticos de
     * verificacao de conta e redefinicao de senha pelo layout com a
     * identidade visual do LivroNet (resources/views/emails/layout.blade.php).
     *
     * Nao precisa mexer no AuthController: sendEmailVerificationNotification()
     * e Password::sendResetLink() continuam disparando as notifications
     * padrao do Laravel, que passam a usar esses Mailables por baixo dos
     * panos.
     */
    protected function useBrandedAuthEmails(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, string $url) {
            return (new VerifyEmailMail($url, $notifiable->name))
                ->to($notifiable->email);
        });

        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            $resetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->email,
            ], false));

            $expireMinutes = config(
                'auth.passwords.'.config('auth.defaults.passwords').'.expire'
            );

            return (new ResetPasswordMail($resetUrl, $notifiable->name, $expireMinutes))
                ->to($notifiable->email);
        });
    }
}

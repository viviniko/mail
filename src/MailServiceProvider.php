<?php

namespace Viviniko\Mail;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Viviniko\Mail\Console\Commands\MailTableCommand;

class MailServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/mail.php' => config_path('mail.php'),
        ]);

        // Register commands
        $this->commands('command.mail.table');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mail.php', 'mail');

        $this->registerRepositories();

        $this->registerTemplateService();

        $this->registerMailService();

        $this->registerCommands();
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.mail.table', function ($app) {
            return new MailTableCommand($app['files'], $app['composer']);
        });
    }

    public function registerRepositories()
    {
        $this->app->singleton(
            \Viviniko\Mail\Repositories\Alias\AliasRepository::class,
            \Viviniko\Mail\Repositories\Alias\EloquentAlias::class
        );
        $this->app->singleton(
            \Viviniko\Mail\Repositories\Domain\DomainRepository::class,
            \Viviniko\Mail\Repositories\Domain\EloquentDomain::class
        );
        $this->app->singleton(
            \Viviniko\Mail\Repositories\Template\TemplateRepository::class,
            \Viviniko\Mail\Repositories\Template\EloquentTemplate::class
        );
        $this->app->singleton(
            \Viviniko\Mail\Repositories\User\UserRepository::class,
            \Viviniko\Mail\Repositories\User\EloquentUser::class
        );
    }

    public function registerTemplateService()
    {
        $this->app->singleton(
            \Viviniko\Mail\Contracts\TemplateService::class,
            \Viviniko\Mail\Services\Template\TemplateServiceImpl::class
        );
    }

    /**
     * Register the mail service provider.
     *
     * @return void
     */
    protected function registerMailService()
    {
        $this->app->singleton(
            \Viviniko\Mail\Contracts\MailService::class,
            \Viviniko\Mail\Services\Mail\MailServiceImpl::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            \Viviniko\Mail\Contracts\MailService::class,
            \Viviniko\Mail\Contracts\TemplateService::class
        ];
    }
}
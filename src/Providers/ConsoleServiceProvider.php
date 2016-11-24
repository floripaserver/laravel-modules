<?php

namespace Llama\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Llama\Modules\Commands\CommandCommand;
use Llama\Modules\Commands\ControllerCommand;
use Llama\Modules\Commands\DisableCommand;
use Llama\Modules\Commands\DumpCommand;
use Llama\Modules\Commands\EnableCommand;
use Llama\Modules\Commands\GenerateEventCommand;
use Llama\Modules\Commands\GenerateJobCommand;
use Llama\Modules\Commands\GenerateListenerCommand;
use Llama\Modules\Commands\GenerateMailCommand;
use Llama\Modules\Commands\GenerateMiddlewareCommand;
use Llama\Modules\Commands\GenerateNotificationCommand;
use Llama\Modules\Commands\GenerateProviderCommand;
use Llama\Modules\Commands\GenerateRouteProviderCommand;
use Llama\Modules\Commands\InstallCommand;
use Llama\Modules\Commands\ListCommand;
use Llama\Modules\Commands\MakeCommand;
use Llama\Modules\Commands\MakeRequestCommand;
use Llama\Modules\Commands\MigrateCommand;
use Llama\Modules\Commands\MigrateRefreshCommand;
use Llama\Modules\Commands\MigrateResetCommand;
use Llama\Modules\Commands\MigrateRollbackCommand;
use Llama\Modules\Commands\MigrationCommand;
use Llama\Modules\Commands\ModelCommand;
use Llama\Modules\Commands\PublishCommand;
use Llama\Modules\Commands\PublishConfigurationCommand;
use Llama\Modules\Commands\PublishMigrationCommand;
use Llama\Modules\Commands\PublishTranslationCommand;
use Llama\Modules\Commands\SeedCommand;
use Llama\Modules\Commands\SeedMakeCommand;
use Llama\Modules\Commands\SetupCommand;
use Llama\Modules\Commands\UpdateCommand;
use Llama\Modules\Commands\UseCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        MakeCommand::class,
        CommandCommand::class,
        ControllerCommand::class,
        DisableCommand::class,
        EnableCommand::class,
        GenerateEventCommand::class,
        GenerateListenerCommand::class,
        GenerateMiddlewareCommand::class,
        GenerateProviderCommand::class,
        GenerateRouteProviderCommand::class,
        InstallCommand::class,
        ListCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrationCommand::class,
        ModelCommand::class,
        PublishCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        SetupCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        DumpCommand::class,
        MakeRequestCommand::class,
        PublishConfigurationCommand::class,
        GenerateJobCommand::class,
        GenerateMailCommand::class,
        GenerateNotificationCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = $this->commands;

        return $provides;
    }
}

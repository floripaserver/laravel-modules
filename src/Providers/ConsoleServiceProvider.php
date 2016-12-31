<?php

namespace Llama\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Llama\Modules\Commands\MakeCommandCommand;
use Llama\Modules\Commands\MakeControllerCommand;
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
use Llama\Modules\Commands\MakeMigrationCommand;
use Llama\Modules\Commands\ModelCommand;
use Llama\Modules\Commands\PublishAssetCommand;
use Llama\Modules\Commands\PublishConfigurationCommand;
use Llama\Modules\Commands\PublishMigrationCommand;
use Llama\Modules\Commands\PublishTranslationCommand;
use Llama\Modules\Commands\SeedCommand;
use Llama\Modules\Commands\MakeSeedCommand;
use Llama\Modules\Commands\SetupCommand;
use Llama\Modules\Commands\UpdateCommand;
use Llama\Modules\Commands\UseCommand;
use Llama\Modules\Commands\PublishSeedCommand;

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
        MakeCommandCommand::class,
        MakeControllerCommand::class,
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
        MakeMigrationCommand::class,
        ModelCommand::class,
        PublishAssetCommand::class,
        PublishMigrationCommand::class,
        PublishTranslationCommand::class,
        SeedCommand::class,
        MakeSeedCommand::class,
        SetupCommand::class,
        UpdateCommand::class,
        UseCommand::class,
        DumpCommand::class,
        MakeRequestCommand::class,
        PublishConfigurationCommand::class,
        GenerateJobCommand::class,
        GenerateMailCommand::class,
        GenerateNotificationCommand::class,
        PublishSeedCommand::class
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

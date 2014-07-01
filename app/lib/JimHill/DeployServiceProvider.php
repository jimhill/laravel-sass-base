<?php namespace JimHill;

use Illuminate\Support\ServiceProvider;
use Jimhill\Commands\CdnDeployCommand;

class DeployServiceProvider extends ServiceProvider
{
    
    /**
     * Register
     * 
     * @return void
     */
    public function register()
    {
        //$this->addCommands();
    }

    public function boot()
    {
        $this->addCommands();
    }

    /**
     * Add commands
     * 
     * @return void
     */
    public function addCommands()
    {
        // Add commands in here
        $commands = array(
            'command.cdn.deploy' => new CdnDeployCommand
        );

        // Add to IoC
        foreach($commands as $command) {
            $this->app->bind('command.cdn.deploy', function($app) use ($command) {
                return $command;
            });
        }

        // Add to artisan commands
        $events = $this->app['events'];
        $events->listen('artisan.start', function($artisan) use ($commands)
        {
            $artisan->resolveCommands(array_keys($commands));
        });

    }
    
}
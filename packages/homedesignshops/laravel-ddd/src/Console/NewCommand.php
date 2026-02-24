<?php


namespace HomeDesignShops\LaravelDdd\Console;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class NewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:new {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new DDD structure for the module / component.';

    /**
     * Execute the console command.
     *
     * @return int|void
     */
    public function handle()
    {
        $this->setModule($this->argument('name'));

        if($this->option('force'))
        {
            (new Filesystem())->deleteDirectory($this->modulePath);
        }

        if($this->moduleExists($this->modulePath)) {
            $this->error(sprintf('Module %s exists already.', $this->moduleName));
            return self::FAILURE;
        }

        $this->ensureModuleDirectoriesExists($this->modulePath);

        $this->createModuleApplicationFiles($this->modulePath, $this->getModuleName(), $this->moduleName);

        $this->createModuleDomainFiles($this->modulePath, $this->moduleName);

        $this->createModuleInfrastructureFiles($this->modulePath, $this->moduleName);

        $this->createModulePresentationFiles($this->modulePath, $this->moduleName);

        $this->info(sprintf('%s structure created!', $this->moduleName));

    }
}
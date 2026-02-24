<?php


namespace HomeDesignShops\LaravelDdd\Console;


class UseCaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:use-case {module} {name} {--list}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Use Case for the module / component.';

    /**
     * Execute the console command.
     *
     * @return int|void
     */
    public function handle()
    {
        $this->setModule($this->argument('module'));
        $isList = $this->hasOption('list');

        if(!$this->moduleExists($this->modulePath)) {
            $this->error(sprintf('Module %s not found.', $this->moduleName));
            return self::FAILURE;
        }

        $this->createModuleApplicationFiles(
            $this->modulePath,
            $this->argument('name'),
            !$isList
        );

        if($isList) {
            $this->createListUseCaseFiles(
                $this->modulePath . 'Application/' . $this->argument('name') .'/',
                $this->argument('name'),
                $this->moduleName
            );
        }

        $this->info(sprintf('Use Case %s created!', $this->argument('name')));
    }
}
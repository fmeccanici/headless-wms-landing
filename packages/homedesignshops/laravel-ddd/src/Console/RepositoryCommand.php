<?php


namespace HomeDesignShops\LaravelDdd\Console;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:repository {module} {name} {--interface}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new repository or repository interface for the module / component.';

    /**
     * Execute the console command.
     *
     * @return int|void
     */
    public function handle()
    {
        $this->setModule($this->argument('module'));

        if(!$this->moduleExists($this->modulePath)) {
            $this->error(sprintf('Module %s not found.', $this->moduleName));
            return self::FAILURE;
        }

        $repositoryName = Str::ucfirst($this->argument('name'));

        if($this->option('interface')) {
            $this->createRepositoryInterface($repositoryName);
            $repositoryName = 'interface ' . $repositoryName;
        } else {
            $this->createRepository($repositoryName);
        }

        $this->info(sprintf('Repository %s created!', $repositoryName));
    }

    /**
     * @param string $repositoryName
     */
    protected function createRepositoryInterface(string $repositoryName): void
    {
        $repositoryName = Str::finish($repositoryName, 'RepositoryInterface');
        $repositoryPath = $this->modulePath . '/Domain/Repositories/' . $repositoryName . '.php';

        (new Filesystem())->copy(
            __DIR__ . '/../../stubs/Module/Infrastructure/Repositories/EloquentModelRepository.php',
            $repositoryPath
        );

        $this->replaceInFile('Module', $this->moduleName, $repositoryPath);
        $this->replaceInFile('EloquentModelRepository', $repositoryName, $repositoryPath);
    }

    /**
     * @param string $repositoryName
     */
    protected function createRepository(string $repositoryName): void
    {
        $repositoryName = Str::finish($repositoryName, 'Repository');
        $repositoryPath = $this->modulePath . '/Infrastructure/Repositories/' . $repositoryName . '.php';

        (new Filesystem())->copy(
            __DIR__ . '/../../stubs/Module/Infrastructure/Repositories/EloquentModelRepository.php',
            $repositoryPath
        );

        $this->replaceInFile('Module', $this->moduleName, $repositoryPath);
        $this->replaceInFile('EloquentModelRepository', $repositoryName, $repositoryPath);
    }
}
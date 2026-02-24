<?php


namespace HomeDesignShops\LaravelDdd\Console;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ConsoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:command {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new console command for the module / component.';

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

        $commandName = Str::studly($this->argument('name'));

        $this->createCommand($commandName);

        $this->info(sprintf('Command %s created!', $commandName));
    }

    /**
     * @param string $commandName
     */
    protected function createCommand(string $commandName): void
    {
        $commandName = Str::finish($commandName, 'Command');
        $repositoryPath = $this->modulePath . '/Presentation/Console/Commands/' . $commandName . '.php';

        (new Filesystem())->copy(
            __DIR__ . '/../../stubs/Module/Presentation/Console/Commands/ExampleCommand.php',
            $repositoryPath
        );

        $this->replaceInFile('Module', $this->moduleName, $repositoryPath);
        $this->replaceInFile('ExampleCommand', $commandName, $repositoryPath);
    }
}
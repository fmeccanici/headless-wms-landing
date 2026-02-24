<?php


namespace HomeDesignShops\LaravelDdd\Console;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class ControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:controller {module} {name} {--api}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new controller for the module / component.';

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

        $controllerName = Str::studly($this->argument('name'));

        $consoleResult = sprintf('Controller %s created!', $controllerName);

        if($this->option('api')) {
            $consoleResult = 'Api ' . $consoleResult;
            $this->createController($controllerName, true);
        } else {
            $this->createController($controllerName);
        }

        $this->info($consoleResult);
    }

    /**
     * @param string $controllerName
     */
    protected function createController(string $controllerName, $isApi = false): void
    {
        $controllerName = Str::finish($controllerName, 'Controller');
        $controllerPath = sprintf('%s%s%s',
            $this->modulePath . '/Presentation/Http/',
            $isApi ? 'Api/' : '',
            $controllerName . '.php'
        );

        $controllerStubPath = sprintf('%s%s%s',
            __DIR__ . '/../../stubs/Module/Presentation/Http/',
            $isApi ? 'Api/' : '',
            'ModelController.php'
        );

        (new Filesystem())->copy(
            __DIR__ . '/../../stubs/Module/Presentation/Http/'.'ModelController.php',
            $controllerPath
        );

        $this->replaceInFile('Module', $this->moduleName, $controllerPath);
        $this->replaceInFile('ModelController', $controllerName, $controllerPath);
    }
}
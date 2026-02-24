<?php


namespace HomeDesignShops\LaravelDdd\Console;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class DtoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ddd:dto {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new DTO for the module / component.';

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

        $dtoName = Str::ucfirst($this->argument('name'));
        $dtoPath = $this->modulePath . '/Infrastructure/' . $dtoName . '.php';


        (new Filesystem())->copy(
            __DIR__ . '/../../stubs/Dto.php',
            $dtoPath
        );

        $this->replaceInFile('Module', $this->moduleName, $dtoPath);
        $this->replaceInFile('Dto', $dtoName, $dtoPath);

        $this->info(sprintf('DTO %s created!', $dtoName));
    }
}
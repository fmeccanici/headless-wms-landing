<?php


namespace HomeDesignShops\LaravelDdd\Console;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

abstract class Command extends \Illuminate\Console\Command
{

    /**
     * Name of the module.
     *
     * @var string
     */
    protected $moduleName;

    /**
     * The path of the module.
     *
     * @var string
     */
    protected $modulePath;

    /**
     * Sets the module application files
     */
    protected function createModuleApplicationFiles($modulePath, $module, $createUseCase = true): void
    {
        $moduleName = $this->getModuleName();

        $moduleApplicationPath = $modulePath . 'Application/';
        (new Filesystem())->ensureDirectoryExists($moduleApplicationPath);

        if($createUseCase) {
            $this->createUseCaseFiles(
                $moduleApplicationPath . $module . '/',
                $module,
                $moduleName
            );
        }
    }

    /**
     * Sets the module domain files
     */
    protected function createModuleDomainFiles($modulePath, $module): void
    {
        $moduleName = $this->getModuleName();

        $moduleDomainPath = $modulePath . 'Domain/';
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/Module/Domain', $moduleDomainPath);

        (new Filesystem())->move($moduleDomainPath . 'Repositories/ModelRepositoryInterface.php', $moduleDomainPath . 'Repositories/' . $module . 'RepositoryInterface.php');
        (new Filesystem())->move($moduleDomainPath . 'Model.php', $moduleDomainPath . $module . '.php');

        $this->replaceInFile('Module', $moduleName, $moduleDomainPath . 'Repositories/' . $module . 'RepositoryInterface.php');
        $this->replaceInFile('Model', $module, $moduleDomainPath . 'Repositories/' . $module . 'RepositoryInterface.php');

        $this->replaceInFile('class Model', 'class ' . $module, $moduleDomainPath . $module . '.php');
        $this->replaceInFile('Module', $module, $moduleDomainPath . $module . '.php');
        $this->replaceInFile('module', Str::plural(strtolower($module)), $moduleDomainPath . $module . '.php');
    }

    /**
     * Sets the module infrastructure files
     */
    protected function createModuleInfrastructureFiles($modulePath, $module): void
    {
        $moduleName = $this->getModuleName();

        $moduleInfrastructurePath = $modulePath . 'Infrastructure/';
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/Module/Infrastructure', $moduleInfrastructurePath);

        (new Filesystem())->move($moduleInfrastructurePath . 'Providers/ModuleServiceProvider.php', $moduleInfrastructurePath . 'Providers/' . $module . 'ServiceProvider.php');
        (new Filesystem())->move($moduleInfrastructurePath . 'Repositories/EloquentModelRepository.php', $moduleInfrastructurePath . 'Repositories/Eloquent' . $module . 'Repository.php');

        $this->replaceInFile('Module', $moduleName, $moduleInfrastructurePath . 'Repositories/Eloquent' . $module . 'Repository.php');
        $this->replaceInFile('Model', $module, $moduleInfrastructurePath . 'Repositories/Eloquent' . $module . 'Repository.php');

        $this->replaceInFile('ModuleName', $module, $moduleInfrastructurePath . 'Providers/' . $module . 'ServiceProvider.php');
        $this->replaceInFile('modulename', strtolower($module), $moduleInfrastructurePath . 'Providers/' . $module . 'ServiceProvider.php');
    }

    /**
     * Set the module presentation files
     */
    protected function createModulePresentationFiles($modulePath, $module): void
    {
        $moduleName = $this->getModuleName();

        $modulePresentationPath = $modulePath . 'Presentation/';
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/Module/Presentation/', $modulePresentationPath);

        (new Filesystem())->move($modulePresentationPath . 'Http/ModelController.php', $modulePresentationPath . 'Http/' . $module . 'Controller.php');
        (new Filesystem())->move($modulePresentationPath . 'Http/Api/ModelController.php', $modulePresentationPath . 'Http/Api/' . $module . 'Controller.php');

        $this->replaceInFile('Module', $moduleName, $modulePresentationPath . 'Http/' . $module . 'Controller.php');
        $this->replaceInFile('Model', $module, $modulePresentationPath . 'Http/' . $module . 'Controller.php');

        $this->replaceInFile('Module', $moduleName, $modulePresentationPath . 'Http/Api/' . $module . 'Controller.php');
        $this->replaceInFile('Model', $module, $modulePresentationPath . 'Http/Api/' . $module . 'Controller.php');

        $this->replaceInFile('Module', $moduleName, $modulePresentationPath . 'Http/Routes/api.php');
        $this->replaceInFile('module', strtolower($module), $modulePresentationPath . 'Http/Routes/api.php');
        $this->replaceInFile('Model', $module, $modulePresentationPath . 'Http/Routes/api.php');

        $this->replaceInFile('Module', $moduleName, $modulePresentationPath . 'Http/Routes/web.php');
        $this->replaceInFile('module', strtolower($module), $modulePresentationPath . 'Http/Routes/web.php');
        $this->replaceInFile('Model', $module, $modulePresentationPath . 'Http/Routes/web.php');
    }

    /**
     * Ensure the main directories of the model exists.
     */
    protected function ensureModuleDirectoriesExists($modulePath): void
    {
        $moduleDirectories = [
            'Application',
            'Domain',
            'Infrastructure',
            'Presentation'
        ];

        try {
            // Ensure the main directory exists
            (new Filesystem())->ensureDirectoryExists($modulePath);

            foreach ($moduleDirectories as $moduleDirectory)
            {
                (new Filesystem())->ensureDirectoryExists($modulePath . $moduleDirectory);
            }
        } catch (\Exception $e) {
            if (! (new Filesystem())->isDirectory($modulePath)) {
                (new Filesystem())->makeDirectory($modulePath);
            }

            foreach ($moduleDirectories as $moduleDirectory)
            {
                $moduleDirPath = $modulePath . $moduleDirectory;
                if (! (new Filesystem())->isDirectory($moduleDirPath)) {
                    (new Filesystem())->makeDirectory($moduleDirPath);
                }
            }
        }
    }

    /**
     * Sets up the module.
     */
    protected function setModule($moduleName): void
    {
        $this->moduleName = $moduleName;
        $path = Str::finish(config('laravel-ddd.modules_path'), '/');
        $this->modulePath = Str::finish($path . $this->moduleName, '/');
    }

    /**
     * Get the name of the module.
     *
     * @return string
     */
    protected function getModuleName(): string
    {
        return $this->moduleName;
    }

    /**
     * Returns true if $this->modulePath exists.
     *
     * @param $modulePath
     * @return bool
     */
    protected function moduleExists($modulePath): bool
    {
        return (new Filesystem())->isDirectory($modulePath);
    }

    /**
     * Replace a given string within a given file.
     *
     * @param string $search
     * @param string $replace
     * @param string $path
     * @return void
     */
    protected function replaceInFile(string $search, string $replace, string $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    /**
     * @param string $moduleUseCasePath
     * @param $module
     * @param string $moduleName
     * @return void
     */
    protected function createUseCaseFiles(string $moduleUseCasePath, $module, string $moduleName): void
    {
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/Module/Application/UseCase', $moduleUseCasePath);

        (new Filesystem())->move($moduleUseCasePath . 'UseCase.php', $moduleUseCasePath . $module . '.php');
        (new Filesystem())->move($moduleUseCasePath . 'UseCaseInput.php', $moduleUseCasePath . $module . 'Input.php');
        (new Filesystem())->move($moduleUseCasePath . 'UseCaseInterface.php', $moduleUseCasePath . $module . 'Interface.php');
        (new Filesystem())->move($moduleUseCasePath . 'UseCaseResult.php', $moduleUseCasePath . $module . 'Result.php');

        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . '.php');
        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . 'Input.php');
        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . 'Interface.php');
        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . 'Result.php');

        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . '.php');
        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . 'Input.php');
        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . 'Interface.php');
        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . 'Result.php');
    }

    /**
     * @param string $moduleUseCasePath
     * @param $module
     * @param string $moduleName
     * @return void
     */
    protected function createListUseCaseFiles(string $moduleUseCasePath, $module, string $moduleName): void
    {
        (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/Module/Application/ListUseCase', $moduleUseCasePath);

        (new Filesystem())->move($moduleUseCasePath . 'UseCase.php', $moduleUseCasePath . $module . '.php');
        (new Filesystem())->move($moduleUseCasePath . 'UseCaseInput.php', $moduleUseCasePath . $module . 'Input.php');
        (new Filesystem())->move($moduleUseCasePath . 'UseCaseInterface.php', $moduleUseCasePath . $module . 'Interface.php');
        (new Filesystem())->move($moduleUseCasePath . 'UseCaseResult.php', $moduleUseCasePath . $module . 'Result.php');

        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . '.php');
        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . 'Input.php');
        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . 'Interface.php');
        $this->replaceInFile('Module', $moduleName, $moduleUseCasePath . $module . 'Result.php');

        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . '.php');
        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . 'Input.php');
        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . 'Interface.php');
        $this->replaceInFile('UseCase', $module, $moduleUseCasePath . $module . 'Result.php');
    }

}
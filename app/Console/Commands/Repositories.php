<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Repositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repositories {repo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repoFolder = base_path('app/Repositories');
        if (!File::exists($repoFolder))
        {
            File::makeDirectory($repoFolder);   

            $repoInterface = $repoFolder.'/RepositoryInterface.php';

            if (!File::exists($repoInterface))
            {
                File::put($repoInterface, $this->getContentRepoInterface());
            }

            $repoBase = $repoFolder.'/BaseRepository.php';

            if (!File::exists($repoBase))
            {
                File::put($repoBase, $this->getContentRepoClass());
            }

            $this->info('BaseRepository created successfully');
        }

        $repoName = $this->argument('repo');
        $repoFolder = base_path('app/Repositories/'.$repoName);
        if (!File::exists($repoFolder))
        {
            File::makeDirectory($repoFolder);   

            $repoInterface = $repoFolder.'/'.$repoName.'RepositoryInterface.php';

            if (!File::exists($repoInterface))
            {
                File::put($repoInterface, $this->getContentRepoInterface($repoName));
            }

            $repoClass = $repoFolder.'/'.$repoName.'Repository.php';

            if (!File::exists($repoClass))
            {
                File::put($repoClass, $this->getContentRepoClass($repoName));
            }

            $this->info("Repositories for {$repoName} created successfully");
        }
    }

    private function getContentRepoInterface($repoName = null)
    {
        if ($repoName == null)
        {
            return "<?php
namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function find(\$id);

    public function create(\$attribute = []);

    public function update(\$id, \$attribute = []);

    public function delete(\$id);
}";
        }
        else
        {
            return "<?php
namespace App\Repositories\\{$repoName};

use App\Repositories\RepositoryInterface;

interface {$repoName}RepositoryInterface extends RepositoryInterface
{
    
}";
        }
    }

    private function getContentRepoClass($repoName = null)
    {
        if ($repoName == null)
        {
            return "<?php
namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected \$model;

    public function __construct()
    {
        \$this->setModel();
    }

    public function setModel()
    {
        \$this->model = app()->make(\$this->getModel());
    }

    abstract public function getModel();

    public function getAll()
    {
        return \$this->model->all();
    }

    public function find(\$id)
    {
        return \$this->model->find(\$id);
    }

    public function create(\$attribute = [])
    {
        return \$this->model->create(\$attribute);
    }

    public function update(\$id, \$attribute = [])
    {
        \$result = \$this->model->find(\$id);
        if (\$result)
        {
            \$result->update(\$attribute);
            return \$result;
        }
        return false;
    }

    public function delete(\$id)
    {
        \$result = \$this->model->find(\$id);
        if (\$result)
        {
            return \$result->delete();
        }
        return false;
    }
}";
        }
        else
        {
            return "<?php
namespace App\Repositories\\{$repoName};

use App\Repositories\BaseRepository;
use App\Repositories\\{$repoName}\\{$repoName}RepositoriesInterface;
use App\Models\\{$repoName};

class {$repoName}Repository extends BaseRepository implements {$repoName}RepositoryInterface
{
    public function getModel()
    {
        return {$repoName}::class;
    }
}";
        }
    }
}

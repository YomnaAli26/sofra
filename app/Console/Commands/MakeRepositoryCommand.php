<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $repoName = ucfirst($name) . 'Repository';
        $directory = app_path('Repositories/Eloquent');
        $filePath = $directory . '/' . $repoName . '.php';

        if (!file_exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        $content = <<<EOT
<?php

namespace App\Repositories\Eloquent;

class $repoName
{

    public function __construct()
    {

    }
}
EOT;
        File::put($filePath, $content);
        $this->info("Repository $repoName created successfully!");
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RetagProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $projects = DB::table('projects')->where('projects.tag_id', 1)
        ->rightJoin('tasks', 'projects.id', 'tasks.project_id')
        ->select('projects.id')->get();

        foreach ($projects as $project) {
            $update = Project::find($project->id);
            $update->tag_id = 2;
            $update->save();
        }

        return 0;
    }
}

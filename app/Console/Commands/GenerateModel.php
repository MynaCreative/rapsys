<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:model {table} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Laravel Eloquent model based on a database table';

    /**
     * The table information.
     *
     * @var \TableInformation
     */
    protected $tableInformation;

    /**
     * The path to save the model.
     *
     * @var string
     */
    protected $path;

    /**
     * The stub file.
     *
     * @var string
     */
    protected $stub;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // $this->stub = File::get(__DIR__ . '/stubs/model.stub');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $table = $this->argument('table');
        $this->path = $this->option('path') ?: app_path('Models');
        $this->tableInformation = new TableInformation($table);

        print_r([
            'columns' => $this->tableInformation->columns(),
            'indexes' => $this->tableInformation->indexes(),
            'foreigns' => $this->tableInformation->foreigns(),
            'references' => $this->tableInformation->references(),
            'relations' => $this->tableInformation->relations()
        ]);
    }
}

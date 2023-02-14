<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Console\Commands\TableInformation;

class GenerateModelCommand extends Command
{
    protected $signature = 'create:model {table} {--path=}';

    protected $description = 'Generate Laravel Eloquent model based on a database table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = $this->argument('table');
        $path = $this->option('path') ?? app_path();
        $modelName = Str::studly(Str::singular($table));
        $file = $path . '/' . $modelName . '.php';

        $tableInformation = new TableInformation($table);
        $columns = $tableInformation->columns();
        $foreigns = $tableInformation->foreigns();
        $indexes = $tableInformation->indexes();

        $fillable = [];
        $casts = [];
        $relationships = [];

        foreach ($columns as $column) {
            $fillable[] = $column['name'];
            if ($column['type'] == 'json') {
                $casts[$column['name']] = 'array';
            } elseif (in_array($column['type'], ['integer', 'bigint', 'smallint', 'tinyint'])) {
                $casts[$column['name']] = 'integer';
            } elseif (in_array($column['type'], ['float', 'double', 'decimal'])) {
                $casts[$column['name']] = 'float';
            } elseif ($column['type'] == 'boolean') {
                $casts[$column['name']] = 'boolean';
            } elseif ($column['type'] == 'datetime' || $column['type'] == 'timestamp') {
                $casts[$column['name']] = 'datetime';
            }

            if ($column['foreign'] != null) {
                $relationships[] = $column['foreign'];
            }
        }

        $fillable = "[\n        '" . implode("',\n        '", $fillable) . "'\n    ]";
        $casts = "    [\n" . implode("\n", array_map(function ($key, $value) {
            return "        '$key' => '$value',";
        }, array_keys($casts), $casts)) . "\n    ]";

        $modelStub = file_get_contents(__DIR__ . '/stubs/model.stub');
        $modelStub = str_replace('{{modelName}}', $modelName, $modelStub);
        $modelStub = str_replace('{{tableName}}', $table, $modelStub);
        $modelStub = str_replace('{{fillable}}', $fillable, $modelStub);
        $modelStub = str_replace('{{casts}}', $casts, $modelStub);

        $relationshipMethods = '';
        foreach ($relationships as $relationship) {
            $relationshipMethodStub = file_get_contents(__DIR__ . '/stubs/relationship.stub');
            $relationshipMethodStub = str_replace('{{relatedModel}}', $relationship['relatedModel'], $relationshipMethodStub);
            $relationshipMethodStub = str_replace('{{relatedTable}}', $relationship['relatedTable'], $relationshipMethodStub);
            $relationshipMethodStub = str_replace('{{relatedColumn}}', $relationship['relatedColumn'], $relationshipMethodStub);
            $relationshipMethodStub = str_replace('{{primaryColumn}}', $relationship['primaryColumn'], $relationshipMethodStub);
            $relationshipMethodStub = str_replace('{{relationType}}', $relationship['relationType'], $relationshipMethodStub);
            $relationshipMethods .= $relationshipMethodStub;
        }

        $modelStub = str_replace('{{relationships}}', $relationshipMethods, $modelStub);

        if (!file_exists($file)) {
            file_put_contents($file, $modelStub);
            $this->info($modelName . ' model generated successfully at ' . $file);
        } else {
            $this->error($modelName . ' model already exists at ' . $file);
        }
    }
}
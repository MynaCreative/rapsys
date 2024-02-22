<?php

namespace App\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PDOException;
use PDO;

use App\Models\Oracle\Invoice as Model;
use App\Models\Oracle\InvoiceLine as ModelLine;

use App\Exports\Oracle\Header as HeaderReport;
use App\Exports\Oracle\Line as LineReport;

class Oracle
{
    private $pdo;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Area
     */
    public function __construct()
    {
        // Oracle database configuration
        // $host = 'devoradb12.rpx.co.id';
        $host = config('oracle.oracle.host');
        $port = config('oracle.oracle.port');
        $service = config('oracle.oracle.service_name');
        $username = config('oracle.oracle.username');
        $password = config('oracle.oracle.password');

        // PDO DSN string
        $dsn = "oci:dbname=//{$host}:{$port}/{$service}";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            info($e->getMessage());
        }
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function header(Request $request)
    {
        $query = Model::ordering($request)
            ->filtering($request)
            ->searching($request, ['trx_number', 'description', 'currency_code', 'payment_method_lookup_code', 'error_message'])
            ->latest('creation_date');

        return $query->paginate($request->per_page ?? 10)->withQueryString();
    }

    /**
     * Export to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function headerExport($request)
    {
        $date = now()->format('d-m-Y H:i:s');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        return Excel::download(new HeaderReport($request), "{$name}-header-{$date}.xlsx");
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function line(Request $request)
    {
        $query = ModelLine::with('invoice:staging_id,trx_number,status')
            ->ordering($request)
            ->filtering($request)
            ->searching($request, ['dist_code_concat', 'description', 'ppn_code', 'tax_rate_id', 'error_message'])
            ->latest('creation_date');

        return $query->paginate($request->per_page ?? 10)->withQueryString();
    }

    /**
     * Export to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function lineExport($request)
    {
        $date = now()->format('d-m-Y H:i:s');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        return Excel::download(new LineReport($request), "{$name}-line-{$date}.xlsx");
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function fetchQuery($query)
    {
        $stmt = (new self())->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function fetchTable($table)
    {
        $stmt = (new self())->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function latestIdTable($table, $primaryKey)
    {
        $stmt = (new self())->pdo->prepare("SELECT max({$primaryKey})+1 FROM {$table}");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function insertTable($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = (new self())->pdo->prepare($query);
        $stmt->execute(array_values($data));
        return true;
    }
}

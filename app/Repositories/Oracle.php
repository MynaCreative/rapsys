<?php
namespace App\Repositories;

use PDOException;
use PDO;

class Oracle
{
    private $pdo;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Area
     */
    public function __construct() {
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

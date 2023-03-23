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
    public static function fetchTable($table)
    {
        $stmt = (new self())->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

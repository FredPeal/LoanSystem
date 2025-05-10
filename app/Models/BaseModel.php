<?php
declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use Exception;

class BaseModel
{
    private static string $host = '127.0.0.1';
    private static string $db_name = 'loan';
    private static string $username = 'api';
    private static string $password = 'password';

    public array $columns = [];

    public array $hidden = [];
    public string $tableName = "";
    public string $primaryKey = "";
    
    private $conn;

    public static function connect()
    {
        $conn = null;

        try {
            $conn = new PDO(
                'mysql:host=' . self::$host . ';dbname=' . self::$db_name,
                self::$username,
                self::$password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
        return $conn;
    }
    public function validateColumn(array $data): bool
    {
        $columns = array_keys($data);
        foreach ($columns as $column) {
            if (!in_array($column, $this->columns)) {
                print_r($column);
                return false;
            }
        }
        return true;
    }
    public static function create(array $data): bool
    {
        $self = new static();
        if (!$self->validateColumn($data)) {
            throw new Exception("Invalid column");
        }
        $sql = "INSERT INTO {$self->tableName}";
        $columns = array_keys($data);
        $sql.="(".implode(',', $columns).")";
        $values = array_map(function ($column) {
            return ":{$column}";
        }, $columns);
        $values = implode(",", $values);
        ;
        $sql.=" VALUES ({$values})";
        $db = self::connect();
        $smt = $db->prepare($sql);
        return $smt->execute($data);
    }

    public static function find(string $column = "id", mixed $value): array
    {
        $self = new static();
        $sql = "SELECT * FROM {$self->tableName} WHERE {$column} = :{$column}";
        $db = self::connect();
        $smt = $db->prepare($sql);
        $smt->bindParam(":{$column}", $value);
        $smt->execute();
        $data = $smt->fetch(PDO::FETCH_ASSOC);
        // foreach ($self->hidden as $hide) {
        //     if (isset($data[$hide])) {
        //         unset($data[$hide]);
        //     }
        // }
        return $data;
    }
}

<?php
namespace Classes\Models;

use PDO;
use PDOException;

abstract class BaseModel
{
    protected static ?PDO $db = null;
    protected ?int $id = null;



//function de table name

    abstract protected static function tableName(): string;

    //**** */
    protected static function db(): PDO
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO(
                    "mysql:host=localhost;dbname=health_care",
                    "root",
                    "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("DB ERROR: " . $e->getMessage());
            }
        }
        return self::$db;
    }

    public function save(array $data): bool
    {
        if ($this->id === null) {
            $cols = implode(',', array_keys($data));
            $params = ':' . implode(',:', array_keys($data));
            $sql = "INSERT INTO ".static::tableName()." ($cols) VALUES ($params)";
            return self::db()->prepare($sql)->execute($data);
        }

        $fields = [];
        foreach ($data as $k => $v) {
            $fields[] = "$k = :$k";
        }

        $data['id'] = $this->id;
        $sql = "UPDATE " . static::tableName() .
               " SET " . implode(',', $fields) .
               " WHERE id = :id";

        return self::db()->prepare($sql)->execute($data);
    }

    public static function all(): array
    {
        return self::db()
            ->query("SELECT * FROM " . static::tableName())
            ->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = self::db()->prepare(
            "SELECT * FROM " . static::tableName() . " WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public static function deleteById(int $id): bool
    {
        $stmt = self::db()->prepare(
            "DELETE FROM " . static::tableName() . " WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}

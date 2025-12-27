<?php
namespace Classes\Models;

use PDO;
use PDOException;

abstract class BaseModel
{
    protected static ?PDO $db = null;
    protected ?int $id = null;

    abstract protected static function tableName(): string;
    abstract protected static function tableId(): string;

    protected static function db(): PDO
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO(
                    "mysql:host=localhost;dbname=health_care",
                    "root",
                    "",
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("DB ERROR: " . $e->getMessage());
            }
        }
        return self::$db;
    }

    public function save(array $data): bool
    {
        // CREATE
        if ($this->id === null) {
            $cols = implode(',', array_keys($data));
            $params = ':' . implode(',:', array_keys($data));
            $sql = "INSERT INTO " . static::tableName() . " ($cols) VALUES ($params)";
            return self::db()->prepare($sql)->execute($data);
        }

        // UPDATE
        $fields = [];
        foreach ($data as $k => $v) {
            $fields[] = "$k = :$k";
        }

        $data['id'] = $this->id;

        $sql = "UPDATE " . static::tableName() .
               " SET " . implode(',', $fields) .
               " WHERE " . static::tableId() . " = :id";

        return self::db()->prepare($sql)->execute($data);
    }

    public static function all(): array
    {
        return self::db()
            ->query("SELECT * FROM " . static::tableName())
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $stmt = self::db()->prepare(
            "SELECT * FROM " . static::tableName() .
            " WHERE " . static::tableId() . " = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function deleteById(int $id): bool
    {
        $stmt = self::db()->prepare(
            "DELETE FROM " . static::tableName() .
            " WHERE " . static::tableId() . " = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}

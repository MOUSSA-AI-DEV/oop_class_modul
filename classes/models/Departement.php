<?php

namespace Classes\Models;

use Classes\Models\Personne;

class Department extends Personne
{
    protected ?int $id = null;
    protected string $name;
    protected string $location;

   
    protected static function tableName(): string
    {
        return 'departments';
    }

    protected static function tableId(): string
    {
        return 'department_id';
    }

    
    public function __construct(string $name, string $location)
    {
        $this->name = $name;
        $this->location = $location;
    }

   
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function create(): bool
    {
        return $this->save([
            'department_name'     => $this->name,
            'location' => $this->location
        ]);
    }

    public function updateDepartment(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Department ID is required for update.");
        }

        return $this->save([
            'department_name'     => $this->name,
            'location' => $this->location
        ]);
    }

 
    public static function deleteById(int $id): bool
    {
        return parent::deleteById($id);
    }

    public static function allDepartments(): array
    {
        return parent::all();
    }

    public static function findDepartment(int $id): ?array
    {
        return parent::find($id);
    }
}

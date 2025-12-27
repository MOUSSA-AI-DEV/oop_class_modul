<?php

namespace Classes\Models;

use Classes\Models\Personne;

class Patient extends Personne
{
    protected ?int $id = null;
    protected string $first_name;
    protected string $last_name;
    protected string $gender;
    protected string $date_of_birth;
    protected string $phone_number;
    protected string $email;
    protected string $address;

    protected static function tableName(): string
    {
        return 'patients';
    }

    public function __construct(
        string $first_name,
        string $last_name,
        string $gender,
        string $date_of_birth,
        string $phone_number,
        string $email,
        string $address
    )
 {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->date_of_birth = $date_of_birth;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->address = $address;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function create(): bool
    {
        return $this->save([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address
        ]);
    }

    public function updatePatient(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Patient ID is required for update.");
        }

        return $this->save([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address
        ]);
    }

    public static function deleteById(int $id): bool
    {
        return parent::deleteById(parent::connectDatabase(), self::tableName(), $id);
    }

    public static function allPatients(): array
    {
        return parent::all();
    }

    public static function findPatient(int $id): ?array
    {
        return parent::find($id);
    }
}

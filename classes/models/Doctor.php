<?php

namespace Classes\Models;

use Classes\Models\Personne;

class Doctor extends Personne
{
    protected ?int $id = null;

    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $specialization;
    protected string $phone_number;
    protected int $department_id;

    protected static function tableName(): string
    {
        return 'doctors';
    }

    protected static function tableId(): string
    {
        return 'doctor_id';
    }

    public function __construct(
        string $first_name,
        string $last_name,
        string $specialization,
        string $phone_number,
        string $email,
        int $department_id
    ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->specialization = $specialization;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->department_id = $department_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /* ========= CREATE ========= */
    public function create(): bool
    {
        return $this->save([
            'first_name'     => $this->first_name,
            'last_name'      => $this->last_name,
            'specialization' => $this->specialization,
            'phone_number'   => $this->phone_number,
            'email'          => $this->email,
            'department_id'  => $this->department_id,
        ]);
    }

    /* ========= UPDATE ========= */
    public function updateDoctor(): bool
    {
        if ($this->id === null) {
            throw new \Exception("Doctor ID is required for update.");
        }

        return $this->save([
            'first_name'     => $this->first_name,
            'last_name'      => $this->last_name,
            'specialization' => $this->specialization,
            'phone_number'   => $this->phone_number,
            'email'          => $this->email,
            'department_id'  => $this->department_id,
        ]);
    }

    /* ========= DELETE ========= */
    public static function deleteById(int $id): bool
    {
        return parent::deleteById($id);
    }

    /* ========= READ ========= */
    public static function allDoctors(): array
    {
        return parent::all();
    }

    public static function findDoctor(int $id): ?array
    {
        return parent::find($id);
    }
}

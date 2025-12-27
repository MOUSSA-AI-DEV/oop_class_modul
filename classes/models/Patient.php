<?php
namespace Classes\Models;

class Patient extends Personne
{
    protected static function tableName(): string
    {
        return 'patients';
    }

    protected static function tableId(): string
    {
        return 'patient_id';
    }

    protected string $gender;
    protected string $date_of_birth;
    protected string $address;

    public function __construct(
        string $first_name,
        string $last_name,
        string $gender,
        string $date_of_birth,
        string $phone_number,
        string $email,
        string $address
    ) {
        parent::__construct($first_name, $last_name, $phone_number, $email);
        $this->gender = $gender;
        $this->date_of_birth = $date_of_birth;
        $this->address = $address;
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

    public function updatePatient(int $id): bool
    {
        $this->id = $id;

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
}

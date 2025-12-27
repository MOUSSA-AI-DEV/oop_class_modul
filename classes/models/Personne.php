<?php
namespace Classes\Models;

abstract class Personne extends BaseModel
{
    protected string $first_name;
    protected string $last_name;
    protected string $phone_number;
    protected string $email;

    public function __construct(
        string $first_name,
        string $last_name,
        string $phone_number,
        string $email
    ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone_number = $phone_number;
        $this->email = $email;
    }

    // Méthode utilitaire demandée
    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Getters (encapsulation)
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
    
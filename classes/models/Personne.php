<?php
namespace Classes\Models;

abstract class Personne
{
    protected string $nom;
    protected string $prenom;
    protected string $telephone;
    protected string $email;

    public function __construct(
        string $nom,
        string $prenom,
        string $telephone,
        string $email
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
    }

    public function getFullName(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }
}

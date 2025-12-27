<?php
namespace Classes\Models;
use classes\Models\Personnes;


class doctors extends Personne
{
    protected ?int $id=null;
    protected string  $first_name;
    protected string $last_name;
    protected string $spesialization;
    protected string $phone_number;
    protected string $email;
    protected string $department_id;


    protected function tableName(){
        return  "doctors";
    }

    public function __construct(
    string $first_name,
    string $last_name,
    string $email,
    string $spesialization,
    string $phone_number,
    string $department_id
    )
    {
$this->first_name=$first_name;
$this->last_name=$last_name;
$this->email=$email;
$this->spesialization=$spesialization;
$this->phone_number=$phone_number;
$this->department_id=$department_id;

}


public function setId(int $id):void{
    $this->id =$id;
}
public function create(): bool{
return $this->save(
   [ 
    'first_name'=>$this->first_name,
     'last_name'=>$this->last_name,
     'email'=>$this->email,
     'spesialization'=>$this->spesialization,
     'phone_number'=>$this->phone_number,
     'department_id'=>$this->department_id,
    



   ]);


}



    }
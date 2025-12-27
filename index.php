<?php

require_once 'classes/models/BaseModel.php';
require_once 'classes/models/Personne.php';
require_once 'classes/models/Patient.php';
require_once 'classes/models/Doctor.php';
require_once 'classes/models/Departement.php';

use Classes\Models\Patient;
use Classes\Models\Doctor;
use Classes\Models\Department;
use Classes\Models\Personne;

function input(string $msg): string {
    echo $msg;
    return trim(fgets(STDIN));
}

while (true) {
    echo PHP_EOL . "=== Unity Care CLI ===" . PHP_EOL;
    echo "1. Patients" . PHP_EOL;
    echo "2. Doctors" . PHP_EOL;
    echo "3. Departments" . PHP_EOL;
    echo "4. Quit" . PHP_EOL;

    switch (input("Choice: ")) {

        case '1': // PATIENTS
    echo "1. List\n2. Add\n3. Update\n4. Delete\n";

    switch (input("Action: ")) {

        // LIST
        case '1':
            print_r(Patient::allPatients());
            break;

        // CREATE
        case '2':
            $patient = new Patient(
                input("First Name: "),
                input("Last Name: "),
                input("Gender: "),
                input("Date of Birth (YYYY-MM-DD): "),
                input("Phone: "),
                input("Email: "),
                input("Address: ")
            );
            $patient->create();
            echo "Patient added\n";
            break;

        // UPDATE
        case '3':
            $id = (int) input("Patient ID to update: ");

            $patient = new Patient(
                input("New First Name: "),
                input("New Last Name: "),
                input("New Gender: "),
                input("New Date of Birth (YYYY-MM-DD): "),
                input("New Phone: "),
                input("New Email: "),
                input("New Address: ")
            );
            $patient->setId($id);
            $patient->updatePatient();
            echo "Patient updated\n";
            break;

        // DELETE
        case '4':
            Patient::deleteById((int) input("Patient ID to delete: "));
            echo "Patient deleted\n";
            break;
    }
    break;


        case '2'://doctors
            echo "1. List\n2. Add\n3. Delete\n";
            switch (input("Action: ")) {
                case '1':
                    print_r(Doctor::all());
                    break;
                case '2':
                    (new Doctor(
                        input("Nom: "),
                        input("Prenom: "),
                        input("Speciality: ")
                    ))->create();
                    echo "Doctor added\n";
                    break;
                case '3':
                    Doctor::deleteById((int) input("ID: "));
                    echo "Doctor deleted\n";
                    break;
            }
            break;

        case '3':  //departement
            echo "1. List\n2. Add\n3. Delete\n";
            switch (input("Action: ")) {
                case '1':
                    print_r(Department::all());
                    break;
                case '2':
                    (new Department(input("Name: ")))->create();
                    echo "Department added\n";
                    break;
                case '3':
                    Department::deleteById((int) input("ID: "));
                    echo "Department deleted\n";
                    break;
            }
            break;

        case '4':
            exit("Bye\n");
    }
}

<?php

require_once 'classes/models/BaseModel.php';
require_once 'classes/models/Personne.php';
require_once 'classes/models/Patient.php';
require_once 'classes/models/Doctor.php';
require_once 'classes/models/Departement.php';

use Classes\Models\Patient;
use Classes\Models\Doctor;
use Classes\Models\Department;

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

        case '1':
            echo "1. List\n2. Add\n3. Update\n4. Delete\n";

            switch (input("Action: ")) {

                case '1': // LIST
                    print_r(Patient::all());
                    break;

                case '2': // ADD
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

                case '3': // UPDATE
                    $id = (int) input("Patient ID: ");
                    $patient = new Patient(
                        input("First Name: "),
                        input("Last Name: "),
                        input("Gender: "),
                        input("Date of Birth: "),
                        input("Phone: "),
                        input("Email: "),
                        input("Address: ")
                    );
                       $patient->updatePatient($id);
                    echo "Patient updated\n";
                    break;

                case '4': // DELETE
                    Patient::deleteById((int) input("Patient ID: "));
                    echo "Patient deleted\n";
                    break;
            }
            break;

        case '2':
            echo "1. List\n2. Add\n3. Update\n4. Delete\n";

            switch (input("Action: ")) {

                case '1':
                    print_r(Doctor::all());
                    break;

                case '2':
                    (new Doctor(
                        input("First Name: "),
                        input("Last Name: "),
                        input("Specialization: "),
                        input("Phone: "),
                        input("Email: "),
                        (int) input("Department ID: ")
                    ))->create();
                    echo "Doctor added\n";
                    break;

                case '3':
                    $id = (int) input("Doctor ID: ");
                    $doctor = new Doctor(
                        input("First Name: "),
                        input("Last Name: "),
                        input("Specialization: "),
                        input("Phone: "),
                        input("Email: "),
                        (int) input("Department ID: ")
                    );
                         $doctor->setId($id);
                    $doctor->updateDoctor($id);
                    echo "Doctor updated\n";
                    break;

                case '4':
                    Doctor::deleteById((int) input("Doctor ID: "));
                    echo "Doctor deleted\n";
                    break;
            }
            break;

        case '3':
            echo "1. List\n2. Add\n3. Delete\n24 ,update\n ";

            switch (input("Action: ")) {

                case '1':
                    print_r(Department::all());
                    break;

                case '2':
                    (new Department(
                        input("Department Name: "),
                        input("location")
                        
                        ))->create();
                    echo "Department added\n";
                    break;

                case '3':
                    Department::deleteById((int) input("Department ID: "));
                    echo "Department deleted\n";
                    break;
                   case '4':
                          $id = (int) input("Department ID to update: ");
                      
                          $department = new Department(
                              input("New name: "),
                              input("New location: ")
                          );
                      
                          $department->setId($id);
                          $department->updateDepartment();
                      
                          echo "Department updated\n";
                          break;

            }
            break;

        case '4':
            exit("Bye\n");
    }
}

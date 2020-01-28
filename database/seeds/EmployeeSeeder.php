<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Task;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employee::Class,100)
        // qui gli ho detto di crearmi 100 impiegati
         -> create() 
        ->each(function($employee){

            // per andare ad assegnare i task agli employee 
            //prendo una variabile mi prendo in modo casuale un tot di task 
            // e vado ad assegnarli a caso ad ogni employee
            $tasks = Task::inRandomOrder() -> take(rand(0,3)) -> get();
            $employee -> tasks() -> attach($tasks);

        });
    }
}

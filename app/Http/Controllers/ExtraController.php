<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Task;

class ExtraController extends Controller
{ //unica funzione a cui passiamo due parametri perchè 
    //per eliminare la relazione ci servono entrambi gli id degli attori coinvolti
    public function removeTaskFromEmployee($ide,$idt){
       // dd($ide,$idt);
        //mi salvo in una variabile gli elementi associati agli id che invio dal link e ricevo 
       $employee = Employee::findOrFail($ide);
       $task = Task::findOrFail($idt);

       //ora vado a rimuovere la relazione tra i due 
       // bada non si eliminano gli elementi ma la relazione che c'è tra loro 

       $employee -> tasks() -> detach($task);
       return redirect() -> route('employee.index');
    }
}

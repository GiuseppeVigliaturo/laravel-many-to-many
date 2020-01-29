<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    //non ci serve l'id dell'utente perchè è già loggato

    public function setUserImage(Request $request){

        $file = $request -> file('image');
        $filename = $file -> getClientOriginalName();

        //sposto il file da dove si trova ora nella sua postazione definitiva
        //la cartella public
        $file -> move('images', $filename);

        $newUserData =[
            'image' => $filename
        ];

        Auth::user() -> update($newUserData);

        return redirect() -> route('employee.index');
    }
}

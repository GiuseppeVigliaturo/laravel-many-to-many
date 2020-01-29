<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Employee;
use App\Task;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('pages.employee-index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //in questo caso essendo n a n vorrei 
        //poter associare a un nuovo employee dei task
        //invio dunque dal controller tutti i task disponibili e poi li faccio scegliere con una select
        $tasks = Task::all();
        return view('pages.employee-create',compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //bypassa la validazione e butta dentro tutto
        // $data =$request -> all();
        // //questo mi va a buttare dentro la tabella employees un nuovo elemento 
        // $employee = Employee::create($data);
        // //trovo tutti i tag selezionati nelle option che arrivano perchè nella value della option lo invio
        // $tasks = Task::find($data['tasks']);
        // //infine attacco i task selezionati al nuovo employee creato
        // //mi crea una riga nella tabella pivot
        // $employee -> tasks() -> attach($tasks);
        // return redirect() -> route('employee.index');

       
        $data = $request -> all();
        $user = Auth::user();
        $employee = Employee::make($data);
        $employee -> user() -> associate($user);
        $employee -> save();
        
        $tasks = Task::find($data['tasks']);
      
        $employee -> tasks() -> attach($tasks);
        return redirect() -> route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        //essendo che devo dare la possibilità all'utente di aggiungere
        // in fase di creazione tutti i task possibili glieli devo inviare tutti
        //posso farlo anche con la db: nel blade
        $tasks = Task::all();
        return view('pages.employee-edit',compact('employee','tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request -> all();
        // vado a prendere l'elemento su cui voglio effettuare l'operazione
        $employee = Employee::findOrFail($id);
        //modifico l'elemento
         $employee -> update($data);
         //vado quindi ad assegnare il cambiamento ai tasks collegati
        //prima  recupero tutti quelli che l'utente ha selezionato
        $tasks = Task::find($data['tasks']);
        // prendo l'elemento appena modificato e lavorando sulla relazione con i task gli dico tienimi solo quelli che ti sto passando
        $employee -> tasks() -> sync($tasks);

        return redirect() -> route('employee.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //identifico l'elemento da eliminare
        $employee = Employee::findOrFail($id);
        // non posso fare la delete brutalmente perchè l'employee ha associato dei tasks
        //mi prendo i task associati all'employee e li scollego
       
        //posso farlo o con la detouch uno per uno o semplicemente con sync([]) cosi li prende tutti
        $employee -> tasks() -> sync([]);
        //in maniera estesa sarebbe 
        // $tasks = $employee -> tasks;
        // foreach ($tasks as $task){
        //     $employee -> tasks() -> detach($task);
        // }
            $employee -> delete();
        return redirect() -> route('employee.index');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //bypassa la validazione e butta dentro tutto
        $data =$request -> all();
        //questo mi va a buttare dentro la tabella employees un nuovo elemento 
        $employee = Employee::create($data);
        //trovo tutti i tag selezionati nelle option che arrivano perchè nella value della option lo invio
        $tasks = Task::find($data['tasks']);
        //infine attacco i task selezionati al nuovo employee creato
        //mi crea una riga nella tabella pivot
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

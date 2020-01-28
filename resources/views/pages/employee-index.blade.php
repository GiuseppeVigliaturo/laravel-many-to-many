@extends('layouts.base-layout')

@section('content')

<h1>EMPLOYEES</h1>
<ul>
    @foreach ($employees as $employee)
    
        <li> <h4>NOME: {{ $employee -> name}}</h4> 
         <h4>COGNOME: {{ $employee -> lastname}}</h4>

        <ul>
            @foreach ($employee -> tasks as $task)
                <li>
                    {{$task -> title}} 
                </li>
            @endforeach
         </ul>

        </li> 
        

    @endforeach
    </ul>
@endsection
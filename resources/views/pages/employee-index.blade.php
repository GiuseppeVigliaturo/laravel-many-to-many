@extends('layouts.base-layout')

@section('content')

<h1>EMPLOYEES</h1>
<ul>
    @foreach ($employees as $employee)
    
        <li> ID [{{ $employee -> id}}]<h4>NOME: {{ $employee -> name}}</h4> 
         <h4>COGNOME: {{ $employee -> lastname}}</h4>

        <ul>
            @foreach ($employee -> tasks as $task)
                <li>
                <a href="{{route('employee.task.remove', [$employee-> id, $task -> id ])}}">X</a> [{{$task -> id}} ]- {{$task -> title}} 
                </li>
            @endforeach
         </ul>

        </li> 
        

    @endforeach
    </ul>
@endsection
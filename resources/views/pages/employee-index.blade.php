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
                      @auth
                     @if (Auth::user() -> id == $employee -> user ->id )
                 <a href="{{route('employee.task.remove', [$employee-> id, $task -> id ])}}">X</a> 
                  @endif
                @endauth
                [{{$task -> id}} ]- {{$task -> title}} 
            </li>
            @endforeach
         </ul>
         @auth

         @if (Auth::user() -> id == $employee -> user ->id )

        <a href="{{route('employee.edit', $employee -> id)}}">EDIT</a>
        <br>
         <a href="{{route('employee.delete', $employee -> id)}}">DELETE</a>
         @endif
         @endauth

         <br>
        
         author: <strong>{{$employee -> user -> name}}</strong> 
        </li> 
        

    @endforeach
    </ul>
@endsection
@extends('layouts.base-layout')

@section('content')
    
<form action="{{route('employee.update', $employee -> id)}}" method="post">
    @csrf
    @method('POST')

    <label for="name">NAME</label>
<input name = 'name' type="text" value="{{$employee -> name}}">
    <br> <br>
    <label for="lastname">LASTNAME</label>
    <input name = 'lastname' type="text" value="{{$employee -> lastname}}">
    <br>
    <select name ='tasks[]' multiple>
        @foreach ($tasks as $task)

         <option value="{{$task -> id}}"
            
            @if ($employee -> tasks() -> find($task -> id))
                selected
            @endif
            >
            {{$task -> title}}
        </option>

        @endforeach
        
    </select>
     <br>
    <button type="submit">UPDATE</button>

</form>
@endsection
@extends('layouts.base-layout')

@section('content')
    
<form action="{{route('employee.store')}}" method="post">
    @csrf
    @method('POST')

    <label for="name">NAME</label>
    <input name = 'name' type="text" value="">
    <br> <br>
    <label for="lastname">LASTNAME</label>
    <input name = 'lastname' type="text" value="">
    <br>
    <select name ='tasks[]' multiple>
        @foreach ($tasks as $task)
         <option value="{{$task -> id}}">
            {{$task -> title}}
        </option>
        @endforeach
        
    </select>
     <br>
    <button type="submit">CREA</button>

</form>
@endsection
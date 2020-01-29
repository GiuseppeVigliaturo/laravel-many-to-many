<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix ('css/app.css')}}">
    <title>Document</title>
</head>
<body>
    
    <header>

    @auth
        <h1>BENVENUTO : {{Auth::user() -> name}}</h1> <br>
    @else
    <h1>GUEST</h1> 
    @endauth
        
    </header>

  


     @auth
        <form action="{{ route('logout') }}" method="post">
          @csrf
          @method('POST')
          <input type="submit" name="" value="LOGOUT">
        </form>
        <a href="{{ route('employee.create') }}">CREATE NEW EMPLOYEE</a>
      @else

        <a href="{{ route('login') }}">LOGIN</a>
      @endauth

      @auth
      <form action="{{route('user.image.set')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="file" name="image" value=""><br>
        <input type="submit" name="" value="SAVE IMAGE">
      </form>   
      @endauth

      @auth
          @if (Auth::user()-> image)

             <img class='img-fluid' src="{{ asset('images/' . Auth::user() -> image)}}" alt="">
    
          @endif
      @endauth



    @yield('content')

    <footer>
        footer
    </footer>
</body>
</html>
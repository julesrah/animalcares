<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Animal Care</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js" integrity="sha512-PoFg70xtc+rAkD9xsjaZwIMkhkgbl1TkoaRrgucfsct7SVy9KvTj5LtECit+ZjQ3ts+7xWzgfHOGzdolfWEgrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image:linear-gradient(to right, darkslategray , slategray);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: black">
            <div class="container">

             <div class="navbar-header ">
                  <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>

                  <a class="av-link btn btn-outline-success btn-lg"   style="font-family:impact; font-size:30px;color:whitesmoke;" href="{{ url('/') }}"> ANIMAL CARE</a>

                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                    <!-- Left Side Of Navbar -->                     
                    <ul class="navbar-nav me-auto" style="font-family: impact; font-size:50px;">
                     

                         {{-- @if (Auth::check()) --}}

                        @if (Auth::check() && Auth::user()->roles == 'Customer')

                        {{-- <li class="nav-item" role ="button">
                            <a class="av-link btn btn-outline-success btn-lg"  style="font-family:impact;color:whitesmoke;" href="{{ route('getCustomers')}}">
                                 <i class="fa-solid fa-user-plus"></i>Customer</a>      
                        </li>
                        <br>  


                        <li class="nav-item">
                             <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getPets') }}">
                                <i class="fa-solid fa-paw"></i>Pets</a>
                        </li>
                        <br> --}}


                        <li class="nav-item">
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="nav-item">
                           <a class="av-link btn btn-danger btn-lg"   style="font-family:impact; font-size:20px;color:whitesmoke;" href="{{ route('shop.index') }}"> Purchase Service</a>
                        </li>   

                        <li class="nav-item">
                           <a class="av-link btn btn-primary btn-lg"   style="font-family:impact; font-size:20px;color:whitesmoke;" href="{{ route('service.shoppingCart') }}">My Cart</a>
                        </li>   

                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>




                       {{--  <li class="nav-item">
                             <a class="av-link btn btn-outline-warning btn-lg" href="{{ route('getCustomers') }}">Profile</a>
                        </li>


                        <li class="nav-item"  >
                             <a class="av-link btn btn-outline-warning btn-lg" href="{{ route('getCustomers') }}">Log-out</a>
                        </li> --}}
  
                        <li class="dropdown">
                                            <a href="#" class="av-link btn btn-outline-success btn-lg"  data-toggle="dropdown" role="button" aria-haspopup="true"
                                               aria-expanded="false" style="font-family:impact;color:whitesmoke;"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}<span class="caret"></span>
                                            </a>
                                 <ul class="dropdown-menu">
                                    @if (Auth::check())
                                      <li><a href="{{ url('home')}}" class="av-link btn btn-outline-success btn-lg" style="color:white; background-color: black;" >User Profile</a></li>
                                      <li role="separator"></li>


                                     {{--  <li><a href="{{ route('getCustomers')}}" class="av-link btn btn-outline-warning btn-lg" style="color:white; background-color: black;">Logout</a></li> --}}
                                     <li>
                                      <a class="av-link btn btn-outline-success btn-lg" style="color:white; background-color: black;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @else
                                      
                                    @endif
                                  </ul>
                                </li>

                        @elseif (Auth::check() && Auth::user()->roles == 'Employee')

                        <li class="nav-item" >
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="nav-item" role ="button">
                            <a class="av-link btn btn-outline-success btn-lg"  style="font-family:impact;color:whitesmoke;" href="{{ route('getCustomers') }}">
                                 <i class="fa-solid fa-user-plus"></i>Customer</a>      
                        </li>
                        <br>  


                        <li class="nav-item">
                             <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getPets') }}">
                                <i class="fa-solid fa-paw"></i>Pets</a>
                        </li>
                        <br>

                        <li class="nav-item">
                            <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getServices') }}">   
                                 <i class="fa-solid fa-shop"></i>Services</a>
                        </li>
                        <br>

                        <li class="nav-item">
                            <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getEmployees') }}">
                                 <i class="fa-solid fa-user-doctor"></i>Employee</a>
                        </li>

                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="nav-item" >
                          <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getConsultations') }}">
                            <i class="fa-solid fa-stethoscope"></i>Consultation</a>
                        </li>

                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="dropdown">
                                            <a href="#" class="av-link btn btn-outline-success btn-lg" data-toggle="dropdown" role="button" aria-haspopup="true"
                                               aria-expanded="false" style="font-family:impact;color:whitesmoke;"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}<span class="caret"></span>
                                            </a>
                                 <ul class="dropdown-menu">
                                    @if (Auth::check())
                                      <li><a href="{{ url('home')}}" class="av-link btn btn-outline-success btn-lg" style="color:white; background-color: black;" >User Profile</a></li>
                                      <li role="separator"></li>


                                     {{--  <li><a href="{{ route('getCustomers')}}" class="av-link btn btn-outline-warning btn-lg" style="color:white; background-color: black;">Logout</a></li> --}}
                                     <li>
                                      <a class="av-link btn btn-outline-success btn-lg" style="color:white; background-color: black;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @else
                                      
                                    @endif
                                  </ul>
                                </li>

                         @elseif (Auth::check() && Auth::user()->roles == 'Administrator')
                        <li class="nav-item" >
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="nav-item" role ="button">
                            <a class="av-link btn btn-outline-success btn-lg"  style="font-family:impact;color:whitesmoke;" href="{{ route('getCustomers') }}">
                                 <i class="fa-solid fa-user-plus"></i>Customer</a>      
                        </li>
                        <br>  


                        <li class="nav-item">
                             <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getPets') }}">
                                <i class="fa-solid fa-paw"></i>Pets</a>
                        </li>
                        <br>

                        <li class="nav-item">
                            <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getServices') }}">   
                                 <i class="fa-solid fa-shop"></i>Services</a>
                        </li>
                        <br>

                        <li class="nav-item">
                            <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact;color:whitesmoke;" href="{{ route('getEmployees') }}">
                                 <i class="fa-solid fa-user-doctor"></i>Employee</a>
                        </li>

                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="dropdown">
                                            <a href="#" class="av-link btn btn-outline-success btn-lg" data-toggle="dropdown" role="button" aria-haspopup="true"
                                               aria-expanded="false" style="font-family:impact;color:whitesmoke;"><i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name }}<span class="caret"></span>
                                            </a>
                                 <ul class="dropdown-menu">
                                    @if (Auth::check())
                                      <li><a href="{{ url('home')}}" class="av-link btn btn-outline-success btn-lg" style="color:white; background-color: black;">User Profile</a></li>
                                      <li role="separator"></li>

                                     <li>
                                      <a class="av-link btn btn-outline-success btn-lg" style="color:white; background-color: black;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @else
                                      
                                    @endif
                                  </ul>
                                </li>


                        @endif



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest

                            <li class="nav-item">   
                             <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="nav-item">
                            <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact; font-size:20px;color:whitesmoke;" href="{{ route('comment.index') }}">   
                                 <i class="fa-solid fa-shop"></i>Show Services</a>
                        </li>


                            <li class="nav-item">   
                             <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                        <li class="nav-item">
                            <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact; font-size:20px;color:whitesmoke;" href="{{ route('chart.groomed') }}">   
                                 <i class="fa-solid fa-shop"></i>Show Charts</a>
                        </li>



                        <li class="nav-item">   
                          <a class="nav-link" style="font-size:100px;color:white;">|</a>
                        </li>

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact; font-size:20px;color:whitesmoke;" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
           

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="av-link btn btn-outline-success btn-lg" style="font-family:impact; font-size:20px;color:whitesmoke;" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
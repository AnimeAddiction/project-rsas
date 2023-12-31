<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','RFID-Based School Attendance System')</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  @vite(['resources/js/app.js'])
  <script src="https://kit.fontawesome.com/47cd24d297.js" crossorigin="anonymous"></script>
</head>
<link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="images/x-icon"/>

@php
    $space=" ";
    $firstName = auth()->user()->first_name;
    $fullName = auth()->user()->first_name .= $space .= auth()->user()->last_name;
@endphp

<body>

    <!--NAVBAR-->
    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark">
        <div class="container-fluid">
            <a href="/home" class="navbar-brand"><i class="fa-solid fa-clipboard-user icon-white"></i> RFID Attendance System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="#" title="View Account"><i class="fa-solid fa-user icon-white"> @yield('user',$fullName)</i></a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"></a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
        </div>
    </nav>

    @yield('content')
    @yield('scripts')
    @yield('create-user-scripts')
    @yield('update-user-scripts')

</body>

</html>

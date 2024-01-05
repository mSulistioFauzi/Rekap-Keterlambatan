<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Keterlambatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-fb8F+ejTtC0m1Tl1d7CTvZ9tm+cd+KGr9GO4lSd6brfsSAVME9V12tMWI5ZbM+ga" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <h2 class="fs-5">Rekam Keterlambatan</h2>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="{{ route('home') }}" class="sidebar-link">
                            <i class="ri-dashboard-fill"></i>
                            Dashboard
                        </a>
                    </li>
                    @if (Auth::check())
                    @if (Auth::User()->role == "admin")
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="ri-database-fill"></i>
                            Data Master
                        </a>
                        
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('rombel.index') }}" class="sidebar-link mx-4"><i class="ri-building-3-fill"></i> Data Rombel</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('rayon.index') }}" class="sidebar-link mx-4"><i class="ri-building-3-fill"></i> Data Rayon</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('student.index') }}" class="sidebar-link mx-4"><i class="ri-building-3-fill"></i> Data Siswa</a>
                            </li>
                            
                            <li class="sidebar-item">
                                <a href="{{ route('user.index') }}" class="sidebar-link mx-4"><i class="ri-building-3-fill"></i> Data User</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('lates.index') }}" class="sidebar-link collapsed" data-bs-target="#keterlambatan" 
                        aria-expanded="false"><i class="ri-bubble-chart-line"></i>
                        Data Keterlambatan
                    </a>
                     @endif
                     @if (Auth::User()->role == "ps")
                    <li class="sidebar-item">
                        <a href="{{ route('ps.student.data' ,'[id]') }}" class="sidebar-link">
                            <i class="ri-building-3-fill"></i>
                            Data Siswa
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('ps.lates.index') }}" class="sidebar-link collapsed" data-bs-target="#keterlambatan" 
                        aria-expanded="false"><i class="ri-bubble-chart-line"></i>
                        Data Keterlambatan
                    </a>
                    </li>
                    @endif
                    @endif  
                   
                </ul>
            </div>
        </aside>

        
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-ninja"></i>
                                {{ Auth::check() ? Auth::user()->name : 'Belum Login' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('logout') }}" class="dropdown-item" style="color: #fff">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-5">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @if(isset($script) && $script)
</script>
@else
</body>
</html>
@endif


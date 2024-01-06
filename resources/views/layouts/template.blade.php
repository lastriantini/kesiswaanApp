<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>kesiswaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8/x+HBEe5RLoQQGZWSv/2R9WHXFf1b1FR5rSvprkfs-8eG2oepc0QVc9bz86" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </head>
  <style>
    body{
      background-color: rgb(224, 224, 224)smoke;
    }
    #sidebar {
            max-width: 264px;
            min-width: 264px;
            background: var(--bs--light);
            transition: all 0.35s ease-in-out;
            margin: 15px 20px -10px 20px;
            line-height: 50px;
            font-size: 15px;
    } 
    .sidebar-nav {
            flex-grow: 1;
            list-style: none;
            margin-bottom: 0;
            padding-left: 0;
            margin-left: 0;
        }
    a {
      text-decoration: none !important;
    }

  </style>
  @if(Auth::check())
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5" style="box-shadow: 0 0.2px 1px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19); height: 50px; color: black;">
      <div class="container">
        <ul class="navbar nav">
          <li class="nav-item">
            <a class="navbar-brand" href="#" style="font-size: 17px; margin-left: -30px;">
              Rekam Keterlambatan   
              <i class="bi bi-list ms-1"></i>
            </a>
          </li>
        </ul>
        <div class="navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="user bi bi-person-circle"> {{ Auth::user()->name }}</div>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                  </ul>
              </li>
          </ul>
        </div>
      </div>
    </nav>
    <nav class="nav text-dark flex-column vh-100" id="side-bar" style="box-shadow: 0 0.2px 1px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19); text-decoration: none; background-color: white; width: 240px; margin-top: -50px; padding: 20px 20px 0 20px; font-size: 15px; height: 200%;">
      @if(Auth::user()->role =="admin")
      <aside id="sidebar" >
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{URL('/dashboard')}}" class=" bi bi-border-style mr-2 sidebar-link bi bi-bar-chart-steps mr-2"><ion-icon name="apps-outline"></ion-icon>Dashboard</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed bi bi-bar-chart-steps mr-2" data-bs-target="#pages" data-bs-toggle="collapse"
                    aria-expanded="false"><ion-icon name="document-text-outline"></ion-icon> Data Master<i class="bi bi-caret-down ms-4"></i></a> 
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <ol class="sidebar-item">
                        <a href="{{ route('rombel.index') }}" class="sidebar-link">Data Rombel</a>
                    </ol>
                    <ol class="sidebar-item">
                        <a href="{{ route('rayon.index') }}" class="sidebar-link">Data Rayon</a>
                    </ol>
                    <ol class="sidebar-item">
                        <a href="{{ route('student.index')}}" class="sidebar-link">Data Siswa</a>
                    </ol>
                    <ol class="sidebar-item">
                        <a href="{{ route('user.index') }}" class="sidebar-link">Data User</a>
                    </ol>
                </ul>
            </li>
          </ul>
        </aside>
        <a class="nav-link mt-3" href="{{ route('late.index') }}">
          <i class="bi bi-clipboard2-data mr-1"></i>  Data Keterlambatan
        </a>
        @endif

        @if(Auth::user()->role =="ps")
        <aside id="sidebar" >
          <ul class="sidebar-nav">
              <li class="sidebar-item">
                  <a href="{{URL('/dashboard')}}" class=" bi bi-border-style mr-2 sidebar-link bi bi-bar-chart-steps mr-2"><ion-icon name="apps-outline"></ion-icon>Dashboard</a>
              </li>
              <li class="sidebar-item ">
                <a class=" bi bi-bar-chart-steps" href="{{ route('ps.student.data')}}"><ion-icon name="document-text-outline"></ion-icon> Data Siswa</a> 
              </li>
          </ul>
        </aside>
        <a class="nav-link mt-3" href="{{ route('ps.late.allData') }}">
          <i class="bi bi-clipboard2-data mr-1"></i>  Data Keterlambatan
        </a>
        @endif
  </nav>
  @endif

    <div class="container" style="margin:-570px 0 0 250px;">
      @yield('content')
    </div>
    @stack('script')
  </body>
</html>
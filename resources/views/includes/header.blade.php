     <header class="header header-sticky mb-4">
         <div class="container-fluid">
             <button class="header-toggler px-md-0 me-md-3" type="button"
                 onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                 <i class="fa-light fa-bars"></i>
             </button><a class="header-brand d-md-none" href="#">
                 <svg width="118" height="46" alt="CoreUI Logo">
                     <use xlink:href="{{ url('assets/brand/coreui.svg#full') }}"></use>
                 </svg></a>
             <ul class="header-nav d-none d-md-flex">
                 <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                 <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                 <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
             </ul>
             <ul class="header-nav ms-auto">
                 <li class="nav-item"><a class="nav-link text-dark" href="javascript:void(0)">
                         <strong>{{ Auth::user()->name }}</strong>
                     </a>
                 </li>
                 <li class="nav-item"><a class="nav-link" href="javascript:void(0)">
                         <i class="fa-regular fa-bell"></i>
                     </a></li>
                 <li class="nav-item"><a class="nav-link" href="javascript:void(0)">
                         <i class="fa-regular fa-list-radio"></i>
                     </a></li>
                 <li class="nav-item"><a class="nav-link" href="javascript:void(0)">
                         <i class="fa-regular fa-envelope-open"></i>
                     </a></li>
             </ul>
             <ul class="header-nav ms-3">
                 <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
                         role="button" aria-haspopup="true" aria-expanded="false">
                         <div class="avatar avatar-md"><img class="avatar-img"
                                 src="{{ url('assets/img/avatars/8.jpg') }}" alt="user@email.com"></div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end pt-0">
                         <div class="dropdown-header bg-light py-2">
                             <div class="fw-semibold">Settings</div>
                         </div>
                         <a class="dropdown-item" href="{{ route('password.request') }}">
                             <i class="fa-regular fa-unlock icon me-2"></i>Lupa Password</a>
                         <form action="{{ route('logout') }}" method="POST" class="dropdown-item ">
                             @csrf
                             <i class="fa-light fa-arrow-right-from-bracket"></i>
                             <button type="submit" class="btn-out icon me-2">Keluar</button>
                         </form>
                     </div>
                 </li>
             </ul>
         </div>
         <div class="header-divider"></div>
         <div class="container-fluid">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb my-0 ms-2">
                     <li class="breadcrumb-item">
                         <!-- if breadcrumb is single--><span>Home</span>
                     </li>
                     <li class="breadcrumb-item active"><span>Dashboard</span></li>
                 </ol>
             </nav>
         </div>
     </header>

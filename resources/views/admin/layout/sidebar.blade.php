 <div class="startbar d-print-none">
     <!--start brand-->
     <div class="brand">
         <a href="{{ route('user.dashboard') }}" class="logo">
             <span>
                 <img src="{{ asset('assets/user/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
             </span>
             <span class="">
                 <img src="{{ asset('assets/user/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                 <img src="{{ asset('assets/user/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
             </span>
         </a>
     </div>
     <div class="startbar-menu">
         <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
             <div class="d-flex align-items-start flex-column w-100">
                 <ul class="navbar-nav mb-auto w-100">
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('user.dashboard') }}">
                             <i class="iconoir-report-columns menu-icon"></i>
                             <span>Dashboard</span>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('admin.users') }}">
                             <i class="iconoir-paste-clipboard menu-icon"></i>
                             <span>Users</span>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <div class="startbar-overlay d-print-none"></div>

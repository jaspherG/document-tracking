
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="../assets/img/docu.png" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 font-weight-bold font-weight-bolder text-dark text-gradient">{{$user->type}}</span>
    </a>
  </div>
  <hr class="horizontal dark mt-3">
  <div class="collapse navbar-collapse  w-auto vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-database ps-2 pe-2 text-center text-dark {{ (Request::is('dashboard') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 alert alert-dark mx-4 role=alert text-white text-center text-primary">Student Management</h6>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ ($_page == 'Student Management' ? 'active' : '') }}" href="{{ url('student-management') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i style="font-size: 1rem;" class="fas fa-address-book ps-2 pe-2 text-center text-dark {{ ($_page == 'Student Management' ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Student Record</span>
        </a>
      </li>
      <li class="nav-item pb-2 d-none">
        <a class="nav-link {{ (Request::is('student-list') ? 'active' : '') }}" href="{{ url('student-list') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i style="font-size: 1rem;" class="fas fa-address-card ps-2 pe-2 text-center text-dark {{ (Request::is('student-list') ? 'text-white' : 'text-dark') }} " aria-="true"></i>
            </div>
            <span class="nav-link-text ms-1">Student List</span>
        </a>
      </li>
      <li class="nav-item mt-2 d-none">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 alert alert-dark mx-4 role=alert text-white text-center text-primary">Services</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ ($_page == 'Admission' ? 'active' : '') }}" href="{{ url('admission') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ ($_page == 'Admission' ? 'text-white' : 'text-dark') }} " aria-="true"></i>
          </div>
          <span class="nav-link-text ms-1">Admission Requirement</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link {{ ($_page == 'Returnee'  ? 'active' : '') }} " href="{{ url('returnee') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ ($_page == 'Returnee' ? 'text-white' : 'text-dark') }} " aria-="true"></i>
          </div>
          <span class="nav-link-text ms-1">Returnee Requirement</span>
        </a>  
      </li>
      <li class="nav-item ">
        <a class="nav-link  {{ ($_page == 'Transferee' ? 'active' : '') }}" href="{{ url('transferee') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ ($_page == 'Transferee' ? 'text-white' : 'text-dark') }} " aria-="true"></i>
          </div>
          <span class="nav-link-text ms-1">Transferee Requirement</span>
        </a>
      </li>
      <li class="nav-item d-none">
        <a class="nav-link  {{ ($_page == 'cross-enroll' ? 'active' : '') }}" href="{{ url('cross-enroll') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ ($_page == 'cross-enroll' ? 'text-white' : 'text-dark') }} " aria-d-none="true"></i>
          </div>
          <span class="nav-link-text ms-1">Cross Enroll</span>
        </a>
      </li>
      <li class="nav-item mt-2 d-none">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 alert alert-dark mx-4 role=alert text-white text-center text-primary">Reports</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ ($_page == 'reports' ? 'active' : '') }}" href="{{ url('reports') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-table ps-2 pe-2 text-center text-dark {{ ($_page == 'reports' ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Generate Report</span>
        </a>
      </li>
   
    </ul>
  </div>
</aside>

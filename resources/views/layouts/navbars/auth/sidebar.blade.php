
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="../assets/img/docu.png" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 font-weight-bold font-weight-bolder text-dark text-gradient">Document Tracking & Management System</span>
    </a>
  </div>
  <hr class="horizontal dark mt-3">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-database ps-2 pe-2 text-center text-dark {{ (Request::is('user') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 alert alert-dark mx-4 role=alert text-white text-center text-primary">Student Management</h6>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('StudentManagement') ? 'active' : '') }}" href="{{ url('StudentManagement') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i style="font-size: 1rem;" class="fas fa-address-book ps-2 pe-2 text-center text-dark {{ (Request::is('StudentManagement') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Student Management</span>
        </a>
      </li>
      <li class="nav-item pb-2">
        <a class="nav-link {{ (Request::is('Student-List') ? 'active' : '') }}" href="{{ url('Student-List') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i style="font-size: 1rem;" class="fas fa-address-card ps-2 pe-2 text-center text-dark {{ (Request::is('Student-List') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1">Student List</span>
        </a>
      </li>
      <li class="nav-item mt-2">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 alert alert-dark mx-4 role=alert text-white text-center text-primary">Services</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('tables') ? 'active' : '') }}" href="{{ url('tables') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ (Request::is('user') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Admission</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('re-admission') ? 'active' : '') }} " href="{{ url('re-admission') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ (Request::is('user') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Returnee</span>
        </a>  
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ (Request::is('transferee') ? 'active' : '') }}" href="{{ url('transferee') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ (Request::is('user') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Transferee</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{ (Request::is('Cross-Enroll') ? 'active' : '') }}" href="{{ url('Cross-Enroll') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
          <i style="font-size: 1rem;" class="fas fa-receipt ps-2 pe-2 text-center text-dark {{ (Request::is('Cross-Enroll') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
          </div>
          <span class="nav-link-text ms-1">Cross-Enroll</span>
        </a>
      </li>
      <li class="nav-link mb-0">
      </li>
    </ul>
  </div>
</aside>

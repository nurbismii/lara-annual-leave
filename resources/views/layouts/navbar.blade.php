<nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
  <div class="container-fluid">
    <a class="navbar-brand font-weight-bolder ms-sm-3" href="https://demos.creative-tim.com/soft-ui-design-system/index.html" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
      Sistem Cuti Tahunan
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
      <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
        <li class="nav-item ms-lg-auto">
          <a class="nav-link nav-link-icon me-2" href="#">
            <i class="fa fa-user-check me-1"></i>
            <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="modal" data-bs-target="#editUserAccount{{ Auth::user()->id }}">{{ Auth::user()->name }}</p>
          </a>
        </li>
        <li class="nav-item my-auto ms-3 ms-lg-0">
          <a href="{{ route('logout') }}" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1 mt-2 mt-md-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
  
</nav>
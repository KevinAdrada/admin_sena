<nav class="navbar navbar-expand-lg" style="background-color: #00b646;" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="{{ asset('images/logo-sena.png') }}" alt="logo Sena" class="img-fluid" style="width: 45px; height: 45px; margin-right: 10px;">
      <span class="fw-bold fs-4 text-white">Admin Sena</span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-underline navbar-dark ms-auto mb-2 mb-lg-0 gap-1">
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link text-white px-3 py-2 {{ request()->is('apprentice*') ? 'active' : '' }}" href="/apprentice/list">Apprentices</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link text-white px-3 py-2 {{ request()->is('area*') ? 'active' : '' }}" href="/area/list">Areas</a>
        </li>

        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link text-white px-3 py-2 {{ request()->is('computer*') ? 'active' : '' }}" href="/computer/list">Computers</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link text-white px-3 py-2 {{ request()->is('course*') ? 'active' : '' }}" href="/course/list">Courses</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link text-white px-3 py-2 {{ request()->is('teacher*') ? 'active' : '' }}" href="/teacher/list">Teachers</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link text-white px-3 py-2 {{ request()->is('training_center*') ? 'active' : '' }}" href="/training_center/list">Training Centers</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
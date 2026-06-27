<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Sena</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-underline ms-auto mb-2 mb-lg-0 gap-1">
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link link-body-emphasis px-3 py-2 {{ request()->is('apprentice*') ? 'active' : '' }}" href="/apprentice/create">Apprentices</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link link-body-emphasis px-3 py-2 {{ request()->is('teacher*') ? 'active' : '' }}" href="/teacher/create">Teachers</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link link-body-emphasis px-3 py-2 {{ request()->is('training_center*') ? 'active' : '' }}" href="/training_center/create">Training Centers</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link link-body-emphasis px-3 py-2 {{ request()->is('area*') ? 'active' : '' }}" href="/area/create">Areas</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link link-body-emphasis px-3 py-2 {{ request()->is('computer*') ? 'active' : '' }}" href="/computer/create">Computers</a>
        </li>
        
        <li class="nav-item rounded overflow-hidden">
          <a class="nav-link link-body-emphasis px-3 py-2 {{ request()->is('course*') ? 'active' : '' }}" href="/course/create">Courses</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
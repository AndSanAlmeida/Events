<template>
  <header class="header">
    <nav class="navbar">
      <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
          <!-- Navbar Header-->
          <div class="navbar-header">
            <!-- Navbar Brand -->
            <a href="#" class="navbar-brand">
              <div class="brand-text brand-big">
                <span>Events | André Almeida</span>
              </div>
              <div class="brand-text brand-small">
                <strong>Events</strong>
              </div>
            </a>
            <!-- Toggle Button-->
            <a id="toggle-btn" href="#" class="menu-btn active">
              <span></span>
              <span></span>
              <span></span>
            </a>
          </div>
          <!-- Navbar Menu -->
          <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
            <li class="nav-item">
              <a href="/" class="nav-link" title="Official Page">
                <i class="fal fa-arrow-circle-left" aria-hidden="true"></i>
                Official Page
              </a>
            </li>
            <!-- Messages-->
            <li class="nav-item">
              <a href="#" class="nav-link" title="Perguntas dos utilizadores">
                <i class="fal fa-envelope"></i>
                <span class="badge bg-orange badge-corner">3</span>
              </a>
            </li>
            <!-- Logout    -->
            <li class="nav-item">
              <a href="#" class="nav-link logout" title="Sair">
                Logout
                <i class="fal fa-sign-out"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

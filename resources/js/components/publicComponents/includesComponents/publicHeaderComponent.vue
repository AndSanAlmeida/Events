<template>
  <!-- NAVBAR -->
  <header class="site-navbar mt-3" id="top">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="site-logo col-6">
          <a href="#">Events</a>
        </div>

        <nav class="mx-auto site-navigation">
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li>
              <a href="#" class="nav-link active">Home</a>
            </li>
            <li class="has-children">
              <a href="#">
                Pages
                <!-- <span class="far fa-angle-down pl-1"></span> -->
              </a>
              <ul class="dropdown">
                <li>
                  <a href="#">Services</a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>

        <div class="col-6 site-burger-menu d-block d-lg-none text-right">
          <a href="#" class="site-menu-toggle js-menu-toggle">
            <span class="far fa-bars h3"></span>
          </a>
        </div>
      </div>
    </div>
  </header>
</template>

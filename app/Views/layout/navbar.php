  <!-- partial:partials/_navbar.html -->
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="<?= base_url(); ?>">
              <img src="<?= base_url('skydash-template/images/logo-lldikti.svg'); ?>" class="mr-2" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="<?= base_url(); ?>">
              <img src="<?= base_url('skydash-template/images/Logo.svg'); ?>" alt="logo" />
          </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <img src="<?= base_url('skydash-template/images/Drag.svg'); ?>" alt="">
          </button>
          <ul class="navbar-nav mr-lg-2">
              <li class="nav-item nav-search d-none d-lg-block">
                  <div class="input-group">
                      <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                          <span class="input-group-text" id="search">
                              <i class="icon-search"></i>
                          </span>
                      </div>
                      <input type="text" class="form-control" id="navbar-search-input" placeholder="Search..."
                          aria-label="search" aria-describedby="search">
                  </div>
              </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown"
                      id="profileDropdown">
                      <img src="<?= base_url('skydash-template/images/faces/face28.jpg'); ?>" class="mr-2"
                          alt="profile" />
                      <div>
                          <div class="text-black">LLDikti 3</div>
                          <div class="text-small text-gray">Admin</div>
                      </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item">
                          <i class="ti-settings text-primary"></i>
                          Settings
                      </a>
                      <a class="dropdown-item">
                          <i class="ti-power-off text-primary"></i>
                          Logout
                      </a>
                  </div>
              </li>
              <!-- <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li> -->
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
              data-toggle="offcanvas">
              <span class="icon-menu"></span>
          </button>
      </div>
  </nav>
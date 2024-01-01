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
                      <input type="text" class="form-control" id="navbar-search-input" placeholder="Search..." aria-label="search" aria-describedby="search">
                  </div>
              </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle mr-2" id="notificationDropdown" href="#" data-toggle="dropdown">
                      <iconify-icon icon="solar:bell-bold-duotone" width="20"></iconify-icon>
                  </a>
                  <a class="nav-link" href="">
                      <iconify-icon icon="mdi:email-variant" width="20"></iconify-icon>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                      <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                      <a class="dropdown-item preview-item">
                          <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                  <i class="ti-info-alt mx-0"></i>
                              </div>
                          </div>
                          <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-normal">Application Error</h6>
                              <p class="font-weight-light small-text mb-0 text-muted">
                                  Just now
                              </p>
                          </div>
                      </a>
                      <a class="dropdown-item preview-item">
                          <div class="preview-thumbnail">
                              <div class="preview-icon bg-warning">
                                  <i class="ti-settings mx-0"></i>
                              </div>
                          </div>
                          <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-normal">Settings</h6>
                              <p class="font-weight-light small-text mb-0 text-muted">
                                  Private message
                              </p>
                          </div>
                      </a>
                      <a class="dropdown-item preview-item">
                          <div class="preview-thumbnail">
                              <div class="preview-icon bg-info">
                                  <i class="ti-user mx-0"></i>
                              </div>
                          </div>
                          <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-normal">New user registration</h6>
                              <p class="font-weight-light small-text mb-0 text-muted">
                                  2 days ago
                              </p>
                          </div>
                      </a>
                  </div>
              </li>
              <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown" id="profileDropdown">
                      <img src="<?= base_url('skydash-template/images/faces/face28.jpg'); ?>" class="mr-2" alt="profile" />
                      <div>
                          <div class="text-black">Austin Roberts</div>
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
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="icon-menu"></span>
          </button>
      </div>
  </nav>
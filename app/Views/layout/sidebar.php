      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
              <div class="ml-3 text-gray mb-2">Home</div>
              <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                      <i class="icon-grid menu-icon"></i>
                      <span class="menu-title">Dashboard</span>
                  </a>
              </li>

              <hr class="custom-line">

              <div class="ml-3 text-gray mb-2 mt-4">Pages</div>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                      <iconify-icon icon="material-symbols:home-outline" width="25"></iconify-icon>
                      <span class="menu-title ml-1">Data PT</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ui-basic">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                          </li>
                          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                      <iconify-icon icon="ph:users" width="25"></iconify-icon>
                      <span class="menu-title ml-1">Data Dosen</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="form-elements">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic
                                  Elements</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="collapse" href="#bukti" aria-expanded="false" aria-controls="charts">
                      <iconify-icon icon="ic:outline-email" width="25"></iconify-icon>
                      <span class="menu-title ml-1">Layanan ULT</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="bukti">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"> <a class="nav-link" href="<?= base_url('bukti-potong'); ?>">Bukti
                                  Potong</a></li>
                          <li class="nav-item"> <a class="nav-link" href="<?= base_url(''); ?>">Bukti Bayar</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('pemotong-pajak'); ?>">
                      <iconify-icon icon="octicon:organization-16" width="22"></iconify-icon>
                      <span class="menu-title"> ID Pemotong Pajak</span>
                  </a>
              </li>

              <hr class="custom-line">

              <div class="ml-3 text-gray mb-2 mt-4">Setting</div>
              <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('user'); ?>">
                      <iconify-icon icon="solar:user-linear" width="25"></iconify-icon>
                      <span class="menu-title">User</span>
                  </a>
              </li>
          </ul>
      </nav>
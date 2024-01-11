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
                  <a class="nav-link" href="<?= base_url('bukti-potong'); ?>">
                      <iconify-icon icon="ic:outline-email" width="25"></iconify-icon>
                      <span class="menu-title ml-2">Bukti Potong</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('pemotong-pajak'); ?>">
                      <iconify-icon icon="octicon:organization-16" width="25"></iconify-icon>
                      <span class="menu-title ml-2">Data Pemotong Pajak</span>
                  </a>
              </li>

              <hr class="custom-line">

              <div class="ml-3 text-gray mb-2 mt-4">Setting</div>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <iconify-icon icon="solar:user-linear" width="25"></iconify-icon>
                      <span class="menu-title ml-2">User</span>
                  </a>
              </li>
          </ul>
      </nav>
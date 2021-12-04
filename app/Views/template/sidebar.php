<div id="app-sidepanel" class="app-sidepanel">
   <div id="sidepanel-drop" class="sidepanel-drop"></div>
   <div class="sidepanel-inner d-flex flex-column">
      <a href="/" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
      <div class="app-branding">
         <a class="app-logo" href="/"><img class="logo-icon me-2" src="/assets/images/app-logo.svg" alt="logo"><span class="logo-text">SPK SAW</span></a>

      </div>
      <!--//app-branding-->

      <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
         <ul class="app-menu list-unstyled accordion" id="menu-accordion">
            <li class="nav-item">
               <a class="nav-link <?= $title == 'Dashboard' ? 'active' : ''; ?>" href="/dashboard">
                  <span class="nav-icon">
                     <i class="bi bi-house" style="font-size: 1.5em;"></i>
                  </span>
                  <span class="nav-link-text">Dashboard</span>
               </a>
               <!--//nav-link-->
            </li>

            <?php
            $datamaster = ['Obat', 'Supplier', 'Form Tambah Obat', 'Form Ubah Obat', 'Form Tambah Supplier', 'Form Ubah Supplier']
            ?>
            <li class="nav-item has-submenu">
               <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
               <a class="nav-link submenu-toggle <?= in_array($title, $datamaster) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#datamaster" aria-expanded="false" aria-controls="datamaster">
                  <span class="nav-icon">
                     <i class="bi bi-file-earmark-medical" style="font-size: 1.5em;"></i>
                     </svg>
                  </span>
                  <span class="nav-link-text">Data Master</span>
                  <span class="submenu-arrow">
                     <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                     </svg>
                  </span>
                  <!--//submenu-arrow-->
               </a>
               <!--//nav-link-->

               <div id="datamaster" class="collapse submenu submenu-1 <?= in_array($title, $datamaster) ? 'show' : ''; ?>" data-bs-parent="#menu-accordion">
                  <ul class="submenu-list list-unstyled">
                     <li class="submenu-item"><a class="submenu-link <?= $title == 'Obat' ? 'active' : ''; ?>" href="/obat">Obat</a></li>
                     <li class="submenu-item"><a class="submenu-link <?= $title == 'Supplier' ? 'active' : ''; ?>" href="/supplier">Supplier</a></li>
                  </ul>
               </div>
            </li>
            <!--//nav-item-->


            <?php
            $kriteriavariabel = ['Kriteria', 'Variabel', 'Ubah Bobot'];
            ?>
            <li class="nav-item has-submenu">
               <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
               <a class="nav-link submenu-toggle <?= in_array($title, $kriteriavariabel) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#kriteriavariabel" aria-expanded="false" aria-controls="kriteriavariabel">
                  <span class="nav-icon">
                     <i class="bi bi-card-list" style="font-size: 1.5em;"></i>
                  </span>
                  <span class="nav-link-text">Kriteria dan Variabel</span>
                  <span class="submenu-arrow">
                     <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                     </svg>
                  </span>
                  <!--//submenu-arrow-->
               </a>
               <!--//nav-link-->

               <div id="kriteriavariabel" class="collapse submenu submenu-1 <?= in_array($title, $kriteriavariabel) ? 'show' : ''; ?>" data-bs-parent="#menu-accordion">
                  <ul class="submenu-list list-unstyled">
                     <li class="submenu-item"><a class="submenu-link <?= $title == 'Kriteria' ? 'active' : ''; ?>" href="/kriteria">Kriteria</a></li>
                     <li class="submenu-item"><a class="submenu-link <?= $title == 'Ubah Bobot' ? 'active' : ''; ?>" href="/kriteria/ubahBobot">Bobot</a></li>
                     <li class="submenu-item"><a class="submenu-link <?= $title == 'Variabel' ? 'active' : ''; ?>" href="/variabel">Variabel</a></li>
                  </ul>
               </div>
            </li>
            <!--//nav-item-->
            <?php if ($session['user_role'] == 'admin') : ?>
               <li class="nav-item">
                  <a class="nav-link <?= $title == 'Perhitungan SPK' ? 'active' : ''; ?>" href="/hitung">
                     <span class="nav-icon">
                        <i class="bi bi-calculator" style="font-size: 1.5em;"></i>
                     </span>
                     <span class="nav-link-text">Perhitungan</span>
                  </a>
                  <!--//nav-link-->
               </li>
            <?php endif; ?>
            <li class="nav-item">
               <a class="nav-link <?= $title == 'History Perhitungan' ? 'active' : ''; ?>" href="/hitung/history">
                  <span class="nav-icon">
                     <i class="bi bi-clock-history" style="font-size: 1.5em;"></i>
                  </span>
                  <span class="nav-link-text">History</span>
               </a>
               <!--//nav-link-->
            </li>

         </ul>
         <!--//app-menu-->
      </nav>
      <!--//app-nav-->


   </div>
   <!--//sidepanel-inner-->
</div>
<!--//app-sidepanel-->
</header>
<!--//app-header-->
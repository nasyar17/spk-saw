<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row mb-4">
   <div class="col-12">
      <div class="row g-4 settings-section">
         <div class="col-12 col-md-4">
            <h3 class="section-title">Bobot</h3>
            <div class="section-intro">Semakin besar nilai bobot dari kriteria maka semakin besar persentase pemilihan berdasarkan kriteria tersebut. <br> <b>Isi masing-masing bobot kriteria sehingga jika dijumlahkan bernilai 100%</b></div>
         </div>
         <div class="col-12 col-md-8">

            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
               <div class="app-card-header p-3 border-bottom-0">
                  <div class="row align-items-center gx-3">
                     <div class="col-auto">
                        <div class="app-icon-holder">
                           <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                           </svg>
                        </div>
                        <!--//icon-holder-->

                     </div>
                     <!--//col-->
                     <div class="col-auto">
                        <h4 class="app-card-title">Pembobotan</h4>
                     </div>
                     <!--//col-->
                  </div>
                  <!--//row-->
               </div>
               <!--//app-card-header-->
               <div class="app-card-body px-4 w-100">
                  <form action="/kriteria/saveBobot" method="post">
                     <?php foreach ($kriteria as $k) : ?>
                        <div class="item border-bottom py-3">
                           <div class="row justify-content-between align-items-center">
                              <div class="col-8 col-lg-9">
                                 <div class="item-label"><strong><?= $k['kriteria_id']; ?></strong></div>
                                 <div class="item-data"><?= $k['kriteria_nama']; ?></div>
                              </div>
                              <!--//col-->
                              <div class="col-3 col-lg-2 text-end">
                                 <input type="number" value="<?= (old($k['kriteria_bobot'])) ? old($k['kriteria_bobot']) : $k['kriteria_bobot'] ?>" class="form-control" name="<?= $k['kriteria_id']; ?>" required <?= $session['user_role'] == 'owner' ? 'disabled' : '' ?>>
                              </div>
                              <div class="col-1">
                                 %
                              </div>
                              <!--//col-->
                           </div>
                           <!--//row-->
                        </div>
                     <?php endforeach; ?>
                     <!--//item-->
               </div>
               <!--//app-card-body-->
               <?php if ($session['user_role'] == 'admin') : ?>
                  <div class="app-card-footer p-4 mt-auto">
                     <button type="submit" class="btn app-btn-primary">Simpan Bobot</button>
                  </div>
               <?php endif; ?>
               </form>
               <!--//app-card-footer-->
            </div>
            <!--//app-card-->
         </div>
      </div>
      <hr class="my-4">
   </div>
</div>
</div>



<?= $this->endSection(); ?>
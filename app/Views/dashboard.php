<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<?php if ($session['user_role'] == 'owner') : ?>
   <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
      <div class="inner">
         <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">Selamat Datang, <?= $name; ?>!</h3>
            <div class="row gx-5 gy-3">
               <div class="col-12 col-lg-9">
                  <div>Download laporan perhitungan bulan ini.</div>
               </div>
               <div class="col-12 col-lg-3">
                  <a class="btn app-btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                        <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z" />
                     </svg>Download</a>
               </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      </div>
   </div>
<?php endif; ?>


<div class="row g-4 mb-4">
   <div class="col-6 col-lg-3">
      <div class="app-card app-card-stat shadow-sm border-left-decoration">
         <div class="app-card-body p-3 p-lg-4">
            <h4 class="stats-type mb-1">Total Obat</h4>
            <div class="stats-figure"><?= $rekap['jmlObat']; ?></div>

         </div>

         <a class="app-card-link-mask" href="/obat"></a>
      </div>

   </div>


   <div class="col-6 col-lg-3">
      <div class="app-card app-card-stat shadow-sm border-left-decoration-blue">
         <div class="app-card-body p-3 p-lg-4">
            <h4 class="stats-type mb-1">Jumlah Supplier</h4>
            <div class="stats-figure"><?= $rekap['jmlSupplier']; ?></div>
         </div>

         <a class="app-card-link-mask" href="/supplier"></a>
      </div>

   </div>

   <div class="col-6 col-lg-3">
      <div class="app-card app-card-stat shadow-sm border-left-decoration-purple">
         <div class="app-card-body p-3 p-lg-4">
            <h4 class="stats-type mb-1">Jumlah Perhitungan</h4>
            <div class="stats-figure"><?= $rekap['jmlPerhitungan']; ?></div>
         </div>

         <a class="app-card-link-mask" href="/history"></a>
      </div>

   </div>

   <div class="col-6 col-lg-3">
      <div class="app-card app-card-stat shadow-sm border-left-decoration-red">
         <div class="app-card-body p-3 p-lg-4">
            <h4 class="stats-type mb-1">Kriteria</h4>
            <div class="stats-figure">4</div>
         </div>

         <a class="app-card-link-mask" href="/kriteria"></a>
      </div>

   </div>

</div>



<div class="row g-4 mb-4">
   <div class="col-12 col-lg-8">
      <div class="app-card app-card-progress-list h-100 shadow-sm">
         <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
               <div class="col-auto">
                  <h4 class="app-card-title">Perhitungan Terbaru</h4>
               </div>
               <div class="col-auto">
                  <div class="card-header-action">
                     <a href="/hitung/history">Lihat semua perhitungan</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table table-sm table-hover">
                  <thead>
                     <tr class="text-center">
                        <th>ID</th>
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <th>Nama Supplier</th>
                        <th>Tanggal</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($history as $r) : ?>
                        <tr>
                           <td class="text-center"><?= $r['history_id']; ?></td>
                           <td class="text-center"><?= $r['obat_id']; ?></td>
                           <td class="text-left"><?= $r['obat_nama']; ?></td>
                           <td class="text-center"><?= $r['supplier_nama']; ?></td>
                           <td class="text-center"><?= $r['created_at']; ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>

      </div>

   </div>

   <div class="col-12 col-lg-4">
      <div class="app-card app-card-stats-table h-100 shadow-sm">
         <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
               <div class="col-auto">
                  <h4 class="app-card-title">Statistik Hasil</h4>
               </div>
               <div class="col-auto">
                  <div class="card-header-action">
                     <a href="/hitung/history">Lihat History</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="app-card-body p-3 p-lg-4">
            <div class="table-responsive">
               <table class="table table-borderless mb-0">
                  <thead>
                     <tr>
                        <th class="meta">ID</th>
                        <th class="meta">Obat</th>
                        <th class="meta stat-cell">Jumlah</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($mostFrequent as $r) : ?>
                        <tr>
                           <td><a href="#"><?= $r['obat_id']; ?></a></td>
                           <td><?= $r['obat_nama']; ?></td>
                           <td class="stat-cell"><?= $r['jml']; ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $this->endSection(); ?>
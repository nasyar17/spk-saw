<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row">
   <div class="col-12">
      <div class="app-card">
         <div class="app-card-header p-3">
            <h4 class="app-card-title">
               <div class="row">
                  <div class="col-lg-12">
                     <a href="" class="btn app-btn-indigo w-100 py-3"><i class=" fas fa-download"></i> Unduh Laporan Variabel</a>
                  </div>
               </div>
            </h4>
         </div>
         <div class="app-card-body p-3">
            <!-- <a href="" class="btn app-btn-primary mb-3"><i class="fas fa-download"></i> Unduh Laporan</a> -->
            <div class="table-responsive">
               <table class="table" id="history">
                  <thead>
                     <tr class="text-center">
                        <th>#</th>
                        <th>History ID</th>
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Estimasi Waktu Pengiriman</th>
                        <th>Tanggal</th>
                     </tr>
                  </thead>
                  <tbody class="align-middle">
                     <?php $i = 1; ?>
                     <?php foreach ($history as $r) : ?>
                        <tr>
                           <td><?= $i++; ?></td>
                           <td style="width: 1rem"><?= $r['history_id']; ?></td>
                           <td>
                              <span class="badge bg-primary">
                                 <a href="/obat/edit/<?= $r['obat_id']; ?>" class="text-white"><?= $r['obat_id']; ?></a>
                              </span>
                           </td>
                           <td><?= $r['obat_nama']; ?></td>
                           <td>
                              <span class="badge bg-info">
                                 <a href="/supplier/edit/<?= $r['supplier_id']; ?>" class="text-white"><?= $r['supplier_nama']; ?></a>
                              </span>
                           </td>
                           <td><?= $r['supplier_alamat']; ?></td>
                           <td style="width: 1rem"><?= $r['supplier_waktupengiriman']; ?></td>
                           <td><?= $r['created_at']; ?></td>
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
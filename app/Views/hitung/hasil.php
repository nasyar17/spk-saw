<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row">
   <div class="col-md-6">
      <div class="app-card">
         <div class="app-card-header p-3 bg-primary">
            <h4 class="app-card-title text-white">Nilai Minimum dan Maksimum Tiap Kriteria</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr class="text-center">
                        <th>Nama Kriteria</th>
                        <th>Min</th>
                        <th>Max</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($minMax as $r) : ?>
                        <tr>
                           <td><b><?= $r['kriteria_id'];  ?></b> | <?= $r['kriteria_nama']; ?></td>
                           <td class="text-center"><?= $r['min'];  ?></td>
                           <td class="text-center"><?= $r['max'];  ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="app-card">
         <div class="app-card-header p-3 bg-primary">
            <h4 class="app-card-title text-white">Bobot</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr class="text-center">
                        <th>Nama Kriteria</th>
                        <th></th>
                        <th>Bobot</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($kriteria as $r) : ?>
                        <tr>
                           <td><b><?= $r['kriteria_id']; ?></b> | <?= $r['kriteria_nama']; ?></td>
                           <td><span class="badge rounded-pill <?= $r['costbenefit'] == 'cost' ? 'bg-danger' : 'bg-success'; ?>"><?= $r['costbenefit']; ?></span></td>
                           <td class="text-center"><?= $r['kriteria_bobot']; ?> % (<?= $r['kriteria_bobot'] / 100; ?>)</td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="app-card mt-3">
         <div class="app-card-header p-3 bg-primary">
            <h4 class="app-card-title text-white">Nilai Matriks Keputusan</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table" id="matriks">
                  <thead>
                     <tr class="text-center align-middle">
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <?php foreach ($kriteria as $r) : ?>
                           <th><?= $r['kriteria_id']; ?> <br> <span class="badge rounded-pill <?= $r['costbenefit'] == 'cost' ? 'bg-danger' : 'bg-success'; ?>"><?= $r['costbenefit']; ?></span></th>
                        <?php endforeach; ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $old = ''; ?>
                     <?php foreach ($nilai as $r) : ?>
                        <?php if ($old == $r['obat_id']) : ?>
                           <td class="text-center"><?= $r['variabel_nilai']; ?></td>
                        <?php else : ?>
                           <tr>
                              <td class="text-center"><?= $r['obat_id']; ?></td>
                              <td><?= $r['obat_nama']; ?></td>
                              <td class="text-center"><?= $r['variabel_nilai']; ?></td>
                           <?php endif; ?>
                           <?php $old = $r['obat_id'] ?>
                        <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

      <div class="app-card mt-3">
         <div class="app-card-header p-3 bg-primary">
            <h4 class="app-card-title text-white">Nilai Normalisasi</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table" id="normalisasi">
                  <thead>
                     <tr class="text-center align-middle">
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <?php foreach ($kriteria as $r) : ?>
                           <th>
                              <?= $r['kriteria_id']; ?> (<?= $r['kriteria_bobot']; ?> %) <br> <span class="badge rounded-pill <?= $r['costbenefit'] == 'cost' ? 'bg-danger' : 'bg-success'; ?>"><?= $r['costbenefit']; ?></span>
                           </th>
                        <?php endforeach; ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $old = ''; ?>
                     <?php foreach ($normalisasi as $r) : ?>
                        <?php if ($old == $r['obat_id']) : ?>
                           <td class="text-center"><?= $r['variabel_nilai']; ?></td>
                        <?php else : ?>
                           <tr>
                              <td class="text-center"><?= $r['obat_id']; ?></td>
                              <td><?= $r['obat_nama']; ?></td>
                              <td class="text-center"><?= $r['variabel_nilai']; ?></td>
                           <?php endif; ?>
                           <?php $old = $r['obat_id'] ?>
                        <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-12">
      <div class="app-card mt-3">
         <div class="app-card-header p-3 bg-primary">
            <h4 class="app-card-title text-white">Rekap Hasil Akhir</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table" id="rekap">
                  <thead>
                     <tr class="text-center align-middle">
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <?php foreach ($kriteria as $r) : ?>
                           <th>
                              <?= $r['kriteria_id']; ?> (<?= $r['kriteria_bobot']; ?> %) <br> <span class="badge rounded-pill <?= $r['costbenefit'] == 'cost' ? 'bg-danger' : 'bg-success'; ?>"><?= $r['costbenefit']; ?></span>
                           </th>
                        <?php endforeach; ?>
                        <th>Hasil Akhir</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 0; ?>
                     <?php foreach ($rekap as $r) : ?>
                        <tr>
                           <td class="text-center"><?= $r['obat_id']; ?></td>
                           <td><?= $r['obat_nama']; ?></td>
                           <td class="text-center"><?= $r['K01']; ?></td>
                           <td class="text-center"><?= $r['K02']; ?></td>
                           <td class="text-center"><?= $r['K03']; ?></td>
                           <td class="text-center"><?= $r['K04']; ?></td>
                           <td class="text-center">
                              <?php if ($i == 0) : ?>
                                 <span class="badge bg-success"><?= $r['hasilAkhir']; ?></span>
                              <?php else : ?>
                                 <span class="badge bg-secondary"><?= $r['hasilAkhir']; ?></span>
                              <?php endif; ?>
                           </td>
                        </tr>
                        <?php $i++; ?>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-12">
      <div class="app-card mt-3">
         <div class="app-card-header p-3 bg-primary">
            <h4 class="app-card-title text-white">Kesimpulan</h4>
         </div>
         <div class="app-card-body p-3">
            <h4>Maka yang paling layak dilakukan restock adalah barang dengan :</h4>
            <div class="table-responsive">
               <table class="table">
                  <tbody>
                     <tr>
                        <td>ID</td>
                        <td><?= $obatTerpilih['obat_id']; ?></td>
                     </tr>
                     <tr>
                        <td>Nama</td>
                        <td><?= $obatTerpilih['obat_nama']; ?></td>
                     </tr>
                     <tr>
                        <td>Nama Supplier</td>
                        <td><?= $obatTerpilih['supplier_nama']; ?></td>
                     </tr>
                     <tr>
                        <td>Alamat Supplier</td>
                        <td><?= $obatTerpilih['supplier_alamat']; ?></td>
                     </tr>
                     <tr>
                        <td>Estimasi Waktu Pengiriman</td>
                        <td><?= $obatTerpilih['supplier_waktupengiriman']; ?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="app-card-footer p-3">
            <div class="row">
               <div class="col-lg-12">
                  <a href="/hitung/kalkulasi/true" class="btn app-btn-indigo w-100 py-3"><i class=" fas fa-download"></i> Unduh Rekap Perhitungan</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php session()->setFlashdata(['calculation' => 'false']); ?>

<?= $this->endSection(); ?>
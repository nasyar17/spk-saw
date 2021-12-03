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
                           <td><?= $r['min'];  ?></td>
                           <td><?= $r['max'];  ?></td>
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
                        <th>Bobot</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($kriteria as $r) : ?>
                        <tr>
                           <td><b><?= $r['kriteria_id']; ?></b> | <?= $r['kriteria_nama']; ?></td>
                           <td><?= $r['kriteria_bobot']; ?> % (<?= $r['kriteria_bobot'] / 100; ?>)</td>
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
               <table class="table">
                  <thead>
                     <tr class="text-center">
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <?php foreach ($kriteria as $r) : ?>
                           <th><?= $r['kriteria_id']; ?> (<?= $r['costbenefit']; ?>)</th>
                        <?php endforeach; ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $old = ''; ?>
                     <?php foreach ($nilai as $r) : ?>
                        <?php if ($old == $r['obat_id']) : ?>
                           <td><?= $r['variabel_nilai']; ?></td>
                        <?php else : ?>
                           <tr>
                              <td><?= $r['obat_id']; ?></td>
                              <td><?= $r['obat_nama']; ?></td>
                              <td><?= $r['variabel_nilai']; ?></td>
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
               <table class="table">
                  <thead>
                     <tr class="text-center">
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <?php foreach ($kriteria as $r) : ?>
                           <th><?= $r['kriteria_id']; ?> (<?= $r['kriteria_bobot']; ?> %)</th>
                        <?php endforeach; ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $old = ''; ?>
                     <?php foreach ($normalisasi as $r) : ?>
                        <?php if ($old == $r['obat_id']) : ?>
                           <td><?= $r['variabel_nilai']; ?></td>
                        <?php else : ?>
                           <tr>
                              <td><?= $r['obat_id']; ?></td>
                              <td><?= $r['obat_nama']; ?></td>
                              <td><?= $r['variabel_nilai']; ?></td>
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
            <h4 class="app-card-title text-white">Nilai Matriks Keputusan</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table">
                  <thead>
                     <tr class="text-center">
                        <th>Obat ID</th>
                        <th>Nama Obat</th>
                        <?php foreach ($kriteria as $r) : ?>
                           <th><?= $r['kriteria_id']; ?></th>
                        <?php endforeach; ?>
                        <th>Hasil Akhir</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 0; ?>
                     <?php foreach ($rekap as $r) : ?>
                        <tr>
                           <td><?= $r['obat_id']; ?></td>
                           <td><?= $r['obat_nama']; ?></td>
                           <td><?= $r['K01']; ?></td>
                           <td><?= $r['K02']; ?></td>
                           <td><?= $r['K03']; ?></td>
                           <td><?= $r['K04']; ?></td>
                           <td>
                              <?php if ($i == 0) : ?>
                                 <span class="badge rounded-pill bg-success"><?= $r['hasilAkhir']; ?></span>
                              <?php else : ?>
                                 <span class="badge rounded-pill bg-secondary"><?= $r['hasilAkhir']; ?></span>
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
      </div>
   </div>
</div>


<?= $this->endSection(); ?>
<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row">
   <div class="col-12">
      <div class="app-card">
         <?php if ($session['user_role'] == 'admin') : ?>
            <div class="app-card-header p-3">
               <div class="row text-center">
                  <div class="col-sm-12 col-md-4 mb-2">
                     <a href="obat/tambah" class="btn app-btn-primary w-100 py-3"><i class=" fas fa-plus"></i> Tambah Data Obat</a>
                  </div>
                  <div class="col-sm-12 col-md-4 mb-2">
                     <button type="button" class="btn app-btn-secondary w-100 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class=" fas fa-file-import"></i> Import File Excel
                     </button>
                  </div>
                  <div class="col-sm-12 col-md-4">
                     <a href="obat/printLaporan" class="btn app-btn-indigo w-100 py-3"><i class=" fas fa-download"></i> Unduh Laporan Master Obat</a>
                  </div>
               </div>
            </div>
         <?php endif; ?>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table table-sm" id="obat">
                  <thead>
                     <tr class="text-center">
                        <th>No.</th>
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>ID Supplier</th>
                        <?php foreach ($kriteria as $k) : ?>
                           <th><?= $k['kriteria_nama']; ?></th>
                        <?php endforeach; ?>
                        <?php if ($session['user_role'] == 'admin') : ?>
                           <th>Action</th>
                        <?php endif; ?>
                     </tr>
                  </thead>
                  <tbody class="align-middle">
                     <?php $i = 1; ?>
                     <?php foreach ($obat as $r) : ?>
                        <tr>
                           <td class="text-center"><?= $i++;; ?></td>
                           <td class="text-center"><?= $r['obat_id']; ?></td>
                           <td class="text-left"><?= $r['obat_nama']; ?></td>
                           <td class="text-center"><?= $r['supplier_id']; ?></td>
                           <?php foreach ($nilai as $n) : ?>
                              <?php if ($n['obat_id'] == $r['obat_id']) : ?>
                                 <td class="text-center"><?= $n['variabel_nama']; ?></td>
                              <?php endif; ?>
                           <?php endforeach; ?>
                           <?php if ($session['user_role'] == 'admin') : ?>
                              <td>
                                 <div class="d-flex flex-row">
                                    <a href="/obat/edit/<?= $r['obat_id']; ?>" class="btn app-btn-warning">Ubah</a>
                                    <form action="/obat/<?= $r['obat_id']; ?>" method="POST" class="d-inline" name="form<?= $r['obat_id']; ?>">
                                       <?= csrf_field(); ?>
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn app-btn-danger delete-btn mx-1" id="<?= $r['obat_id']; ?>">Hapus</button>
                                    </form>
                                 </div>
                              </td>
                           <?php endif; ?>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form method="post" action="/obat/simpanExcel" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-9">
                     <h5>Pilih file xls / xlsx !</h5>
                     <div class="input-group">
                        <input type="file" class="form-control" aria-label="Upload" name="obatexcel" id="file" required accept=".xls, .xlsx">
                        <!-- <button class="btn app-btn-primary" type="submit" id="inputGroupFileAddon04">Import</button> -->
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <h3>Catatan Pengisian Data</h3>
                     <h5>Supplier : Isi dengan ID supplier yang ada pada halaman Data Master -> Supplier</h5>
                     <h5>Untuk kolom K01 sampai K04 isi dengan Variabel ID yang ada, bukan dengan Nama Variabel !</h5>
                  </div>
               </div>
               <div class="link-download">
                  <a href="/obat/downloadTemplate">Download template file excel</a>
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn app-btn-primary">Import</button>
         </div>
         </form>
      </div>
   </div>
</div>

<?= $this->endSection(); ?>
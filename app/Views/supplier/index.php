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
                     <a href="supplier/tambah" class="btn app-btn-primary w-100 py-3"><i class=" fas fa-plus"></i> Tambah Data Supplier</a>
                  </div>
                  <div class="col-sm-12 col-md-4 mb-2">
                     <button type="button" class="btn app-btn-secondary w-100 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class=" fas fa-file-import"></i> Import File Excel
                     </button>
                  </div>
                  <div class="col-sm-12 col-md-4">
                     <a href="supplier/printLaporan" class="btn app-btn-indigo w-100 py-3"><i class=" fas fa-download"></i> Unduh Laporan Master Supplier</a>
                  </div>
               </div>
            </div>
         <?php endif; ?>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table table-sm" id="supplier">
                  <thead>
                     <tr class="text-center" id="supplier">
                        <th>#</th>
                        <th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Waktu Pengiriman</th>
                        <?php if ($session['user_role'] == 'admin') : ?>
                           <th>Action</th>
                        <?php endif; ?>
                     </tr>
                  </thead>
                  <tbody class="align-middle">
                     <?php $i = 1; ?>
                     <?php foreach ($supplier as $r) : ?>
                        <tr>
                           <td class="text-center"><?= $i++; ?></td>
                           <td class="text-center"><?= $r['supplier_id']; ?></td>
                           <td class="text-left"><?= $r['supplier_nama']; ?></td>
                           <td class="text-left"><?= $r['supplier_alamat']; ?></td>
                           <td class="text-center"><?= $r['supplier_waktupengiriman']; ?></td>
                           <?php if ($session['user_role'] == 'admin') : ?>
                              <td>
                                 <a href="/supplier/edit/<?= $r['supplier_id']; ?>" class="btn app-btn-warning"><i class="bi bi-pencil-fill"></i> Ubah</a>
                                 <form action="/supplier/<?= $r['supplier_id']; ?>" method="POST" class="d-inline" name="form<?= $r['supplier_id']; ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn app-btn-danger delete-btn" id="<?= $r['supplier_id']; ?>"><i class="bi bi-trash-fill"></i> Hapus</button>
                                 </form>
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
            <form method="post" action="/supplier/simpanExcel" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-9">
                     <h5>Pilih file xls / xlsx !</h5>
                     <div class="input-group">
                        <input type="file" class="form-control" aria-label="Upload" name="fileexcel" id="file" required accept=".xls, .xlsx">
                        <!-- <button class="btn app-btn-primary" type="submit" id="inputGroupFileAddon04">Import</button> -->
                     </div>
                  </div>
               </div>
               <div class="link-download">
                  <a href="/supplier/downloadTemplate">Download template file excel</a>
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
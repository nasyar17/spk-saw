<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row">
   <div class="col-12">
      <div class="app-card">
         <div class="app-card-header p-3">
            <h4 class="app-card-title">
               <div class="row">
                  <div class="col-md-2">
                     <a href="crud1/tambah" class="btn app-btn-primary"><i class=" fas fa-plus"></i> Tambah Data</a>
                  </div>
                  <div class="col-md-10">
                     <form method="post" action="/crud1/simpanExcel" enctype="multipart/form-data">
                        <h5>Import File Excel</h5>
                        <div class="input-group">
                           <input type="file" class="form-control" aria-label="Upload" name="fileexcel" id="file" required accept=".xls, .xlsx">
                           <button class="btn app-btn-primary" type="submit" id="inputGroupFileAddon04">Import</button>
                        </div>
                        <div class="card-header-action mt-2">
                           <a href="/crud1/downloadTemplate">Download template file excel</a>
                        </div>

                     </form>
                  </div>

               </div>
            </h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table" id="crud1">
                  <thead>
                     <tr class="text-center">
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Desc</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody class="text-center">
                     <?php foreach ($crud1 as $r) : ?>
                        <tr>
                           <td>#</td>
                           <td><?= $r['crud_id']; ?></td>
                           <td><?= $r['crud_name']; ?></td>
                           <td><?= $r['crud_desc']; ?></td>
                           <td>
                              <a href="/crud1/edit/<?= $r['crud_id']; ?>" class="btn app-btn-warning"><i class="fas fa-edit"></i> Ubah</a>
                              <form action="/crud1/<?= $r['crud_id']; ?>" method="POST" class="d-inline" name="form<?= $r['crud_id']; ?>">
                                 <?= csrf_field(); ?>
                                 <input type="hidden" name="_method" value="DELETE">
                                 <button type="submit" class="btn app-btn-danger delete-btn" id="<?= $r['crud_id']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                              </form>

                           </td>
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
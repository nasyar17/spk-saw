<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<?php foreach ($kriteria as $k) : ?>
   <div class="row mb-4">
      <div class="col-12">
         <div class="app-card">
            <div class="app-card-header p-3 bg-secondary">
               <h4 class="app-card-title text-uppercase fw-bolder text-white"><?= $k['kriteria_nama']; ?></h4>
            </div>
            <div class="app-card-body p-3">
               <?php if ($session['user_role'] == 'admin') : ?>
                  <a href="/variabel/tambah/<?= $k['kriteria_id']; ?>" class="btn app-btn-primary"><i class="fas fa-plus"></i> Tambah Variabel <?= $k['kriteria_nama']; ?></a>
               <?php endif; ?>
               <div class="table-responsive">
                  <table class="table" id="<?= $k['kriteria_id']; ?>">
                     <thead>
                        <tr class="text-center">
                           <th>#</th>
                           <th>ID Variabel</th>
                           <th>Nama Variabel</th>
                           <th>Nilai</th>
                           <?php if ($session['user_role'] == 'admin') : ?>
                              <th>Action</th>
                           <?php endif; ?>
                        </tr>
                     </thead>
                     <tbody class="text-center">
                        <?php $i = 1; ?>
                        <?php foreach ($variabel as $r) : ?>
                           <?php if ($r['kriteria_id'] == $k['kriteria_id']) : ?>
                              <tr>
                                 <td><?= $i++; ?></td>
                                 <td><?= $r['variabel_id']; ?></td>
                                 <td><?= $r['variabel_nama']; ?></td>
                                 <td><?= $r['variabel_nilai']; ?></td>
                                 <?php if ($session['user_role'] == 'admin') : ?>
                                    <td>
                                       <a href="/variabel/edit/<?= $r['variabel_id']; ?>" class="btn app-btn-warning"><i class="fas fa-edit"></i> Ubah</a>
                                       <form action="/variabel/<?= $r['variabel_id']; ?>" method="POST" class="d-inline" name="form<?= $r['variabel_id']; ?>">
                                          <?= csrf_field(); ?>
                                          <input type="hidden" name="_method" value="DELETE">
                                          <button type="submit" class="btn app-btn-danger delete-btn" id="<?= $r['variabel_id']; ?>"><i class="fas fa-trash"></i> Hapus</button>
                                       </form>
                                    </td>
                                 <?php endif; ?>
                              </tr>
                           <?php endif; ?>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php endforeach; ?>



<?= $this->endSection(); ?>
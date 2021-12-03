<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row">
   <div class="col-12">
      <div class="app-card">
         <div class="app-card-header p-3">
            <h4 class="app-card-title">Kriteria</h4>
         </div>
         <div class="app-card-body p-3">
            <div class="table-responsive">
               <table class="table" id="kriteria">
                  <?php if ($session['user_role'] == 'admin') : ?>
                     <a href="/kriteria/ubahBobot" class="btn app-btn-primary mb-4"><i class="fas fa-edit"></i> Ubah Bobot</a>
                  <?php endif; ?>
                  <thead>
                     <tr class="text-center">
                        <th>Kriteria ID</th>
                        <th>Nama Kriteria</th>
                        <th>Cost / Benefit</th>
                        <th>Bobot</th>
                        <?php if ($session['user_role'] == 'admin') : ?>
                           <th>Action</th>
                        <?php endif; ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($kriteria as $r) : ?>
                        <tr>
                           <td class="text-center"><?= $r['kriteria_id']; ?></td>
                           <td class="text-left"><?= $r['kriteria_nama']; ?></td>
                           <td class="text-center">
                              <?php if ($r['costbenefit'] == 'cost') : ?>
                                 <span class="badge rounded-pill bg-danger text-uppercase"><?= $r['costbenefit']; ?></span>
                              <?php else : ?>
                                 <span class="badge rounded-pill bg-primary text-uppercase"><?= $r['costbenefit']; ?></span>
                              <?php endif; ?>
                           </td>
                           <td class="text-center"><b><?= $r['kriteria_bobot']; ?> %</b></td>
                           <?php if ($session['user_role'] == 'admin') : ?>
                              <td class="text-center">
                                 <a href="/kriteria/edit/<?= $r['kriteria_id']; ?>" class="btn app-btn-warning"><i class="fas fa-edit"></i> Ubah</a>
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


<?= $this->endSection(); ?>
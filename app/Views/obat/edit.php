<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<h1 class="app-page-title"><?= $title; ?></h1>

<div class="row">
   <div class="col-12">
      <div class="app-card">
         <div class="app-card-header p-3">
            <h4 class="app-card-title">

            </h4>
         </div>
         <div class="app-card-body p-3">
            <form method="post" action="/obat/update/<?= $obat['obat_id']; ?>">
               <?= csrf_field(); ?>
               <input type="hidden" name="nilai_id_awal" value="<?= $nilai[0]['nilai_id']; ?>">
               <div class="col-lg-12 mb-3">
                  <label for="obat_id" class="form-label">ID Obat</label>
                  <input type="text" value="<?= (old('obat_id')) ? old('obat_id') : $obat['obat_id'] ?>" class="form-control <?= ($validation->hasError('obat_id') ? 'is-invalid' : ''); ?>" id="obat_id" name="obat_id" required readonly>
                  <div class="invalid-feedback">
                     <?= $validation->getError('obat_id'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="obat_nama" class="form-label">Nama Obat</label>
                  <input type="text" value="<?= (old('obat_nama')) ? old('obat_nama') : $obat['obat_nama'] ?>" class="form-control <?= ($validation->hasError('obat_nama') ? 'is-invalid' : ''); ?>" id="obat_nama" name="obat_nama" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('obat_nama'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="supplier_name" class="form-label">Nama Supplier</label>
                  <select name="supplier_id" class="form-select">
                     <?php foreach ($supplier as $row) : ?>
                        <option value="<?= $row['supplier_id']; ?>" <?= ($obat['supplier_id'] == $row['supplier_id'] ? 'selected' : ''); ?>><?= $row['supplier_nama']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
               <?php foreach ($nilai as $n) : ?>
                  <div class="col-lg-12 mb-3">
                     <label for="" class="form-label"><?= $n['kriteria_nama']; ?></label>
                     <select name="<?= $n['kriteria_id']; ?>" class="form-select">
                        <?php foreach ($variabel as $v) : ?>
                           <?php if ($n['kriteria_id'] == $v['kriteria_id']) : ?>
                              <option value="<?= $v['variabel_id']; ?>" <?= $n['variabel_id'] == $v['variabel_id'] ? 'selected' : ''; ?>><?= $v['variabel_nama']; ?></option>
                           <?php endif; ?>
                        <?php endforeach; ?>
                     </select>
                  </div>
               <?php endforeach ?>

               <button type="reset" class="btn app-btn-danger">Reset</button>
               <button type="submit" class="btn app-btn-primary">Simpan Data</button>
            </form>
         </div>
      </div>
   </div>
</div>


<?= $this->endSection(); ?>
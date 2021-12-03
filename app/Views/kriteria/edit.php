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
            <form method="post" action="/kriteria/update/<?= $kriteria['kriteria_id']; ?>">
               <?= csrf_field(); ?>
               <div class="col-lg-12 mb-3">
                  <label for="kriteria_id" class="form-label">ID Kriteria</label>
                  <input type="text" value="<?= (old('kriteria_id')) ? old('kriteria_id') : $kriteria['kriteria_id'] ?>" class="form-control <?= ($validation->hasError('kriteria_id') ? 'is-invalid' : ''); ?>" id="kriteria_id" name="kriteria_id" required readonly>
                  <div class="invalid-feedback">
                     <?= $validation->getError('kriteria_id'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="kriteria_nama" class="form-label">Nama Kriteria</label>
                  <input type="text" value="<?= (old('kriteria_nama')) ? old('kriteria_nama') : $kriteria['kriteria_nama'] ?>" class="form-control <?= ($validation->hasError('kriteria_nama') ? 'is-invalid' : ''); ?>" id="kriteria_nama" name="kriteria_nama" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('kriteria_nama'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="costbenefit" class="form-label">Jenis Kriteria</label>
                  <select name="costbenefit" class="form-select">
                     <option value="cost" <?= ($kriteria['costbenefit'] == 'cost') ? 'selected' : '' ?>>Cost</option>
                     <option value="benefit" <?= ($kriteria['costbenefit'] == 'benefit') ? 'selected' : '' ?>>Benefit</option>
                  </select>
               </div>

               <button type="reset" class="btn app-btn-danger">Reset</button>
               <button type="submit" class="btn app-btn-primary">Simpan Data</button>
            </form>
         </div>
      </div>
   </div>
</div>


<?= $this->endSection(); ?>
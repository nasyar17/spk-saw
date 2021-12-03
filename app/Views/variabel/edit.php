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
            <form method="post" action="/variabel/update/<?= $variabel['variabel_id']; ?>">
               <?= csrf_field(); ?>
               <div class="col-lg-12 mb-3">
                  <label for="variabel_id" class="form-label">ID Variabel</label>
                  <input type="text" value="<?= (old('variabel_id')) ? old('variabel_id') : $variabel['variabel_id'] ?>" class="form-control <?= ($validation->hasError('variabel_id') ? 'is-invalid' : ''); ?>" id="variabel_id" name="variabel_id" required readonly>
                  <div class="invalid-feedback">
                     <?= $validation->getError('variabel_id'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="variabel_nama" class="form-label">Nama Kriteria</label>
                  <input type="text" value="<?= (old('variabel_nama')) ? old('variabel_nama') : $variabel['variabel_nama'] ?>" class="form-control <?= ($validation->hasError('variabel_nama') ? 'is-invalid' : ''); ?>" id="variabel_nama" name="variabel_nama" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('variabel_nama'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="variabel_nilai" class="form-label">Nilai</label>
                  <input type="number" value="<?= (old('variabel_nilai')) ? old('variabel_nilai') : $variabel['variabel_nilai'] ?>" class="form-control <?= ($validation->hasError('variabel_nilai') ? 'is-invalid' : ''); ?>" id="variabel_nilai" name="variabel_nilai" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('variabel_nilai'); ?>
                  </div>
               </div>


               <button type="reset" class="btn app-btn-danger">Reset</button>
               <button type="submit" class="btn app-btn-primary">Simpan Data</button>
            </form>
         </div>
      </div>
   </div>
</div>


<?= $this->endSection(); ?>
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
            <form method="post" action="/supplier/update/<?= $supplier['supplier_id']; ?>">
               <?= csrf_field(); ?>
               <div class="col-lg-12 mb-3">
                  <label for="supplier_id" class="form-label">ID Supplier</label>
                  <input type="text" value="<?= (old('supplier_id')) ? old('supplier_id') : $supplier['supplier_id'] ?>" class="form-control <?= ($validation->hasError('supplier_id') ? 'is-invalid' : ''); ?>" id="supplier_id" name="supplier_id" required readonly>
                  <div class="invalid-feedback">
                     <?= $validation->getError('supplier_id'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="supplier_nama" class="form-label">Nama Supplier</label>
                  <input type="text" value="<?= (old('supplier_nama')) ? old('supplier_nama') : $supplier['supplier_nama'] ?>" class="form-control <?= ($validation->hasError('supplier_nama') ? 'is-invalid' : ''); ?>" id="supplier_nama" name="supplier_nama" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('supplier_nama'); ?>
                  </div>
               </div>
               <div class="col-lg-12 mb-3">
                  <label for="supplier_alamat" class="form-label">Alamat</label>
                  <input type="text" value="<?= (old('supplier_alamat')) ? old('supplier_alamat') : $supplier['supplier_alamat'] ?>" class="form-control <?= ($validation->hasError('supplier_alamat') ? 'is-invalid' : ''); ?>" id="supplier_alamat" name="supplier_alamat" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('supplier_alamat'); ?>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="supplier_waktupengiriman" class="form-label">Waktu Pengiriman</label>
                  <input type="number" class="form-control <?= ($validation->hasError('supplier_waktupengiriman') ? 'is-invalid' : ''); ?>" id="supplier_waktupengiriman" name="supplier_waktupengiriman" required value="<?= (old('supplier_waktupengiriman')) ? old('supplier_waktupengiriman') : $supplier['supplier_waktupengiriman'] ?>">
                  <div class=" invalid-feedback">
                     <?= $validation->getError('supplier_waktupengiriman'); ?>
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
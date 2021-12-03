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
            <form method="post" action="/crud1/update/<?= $crud1['crud_id']; ?>">
               <?= csrf_field(); ?>
               <input type="hidden" name="crud_id" value="<?= $crud1['crud_id']; ?>">
               <div class="col-lg-12 mb-3">
                  <label for="crud_name" class="form-label">Crud Name</label>
                  <input type="text" value="<?= (old('crud_name')) ? old('crud_name') : $crud1['crud_name'] ?>" class="form-control <?= ($validation->hasError('crud_name') ? 'is-invalid' : ''); ?>" id="crud_name" name="crud_name" required>
                  <div class="invalid-feedback">
                     <?= $validation->getError('crud_name'); ?>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="crud_desc" class="form-label">Crud Desc</label>
                  <input type="text" class="form-control <?= ($validation->hasError('crud_desc') ? 'is-invalid' : ''); ?>" id="crud_desc" name="crud_desc" required value="<?= (old('crud_desc')) ? old('crud_desc') : $crud1['crud_desc'] ?>">
                  <div class=" invalid-feedback">
                     <?= $validation->getError('crud_desc'); ?>
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
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>

   <!-- Meta -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
   <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
   <link rel="shortcut icon" href="favicon.ico">

   <!-- FontAwesome JS-->
   <script defer src="/assets/plugins/fontawesome/js/all.min.js"></script>

   <!-- Bootstrap Icon -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

   <!-- App CSS -->
   <link id="theme-style" rel="stylesheet" href="/assets/css/portal.css">
   <link rel="stylesheet" href="/assets/css/custom.css">

</head>

<body class="app">
   <!-- NAVBAR -->
   <?= $this->include('template/navbar'); ?>
   <?= $this->include('template/sidebar'); ?>


   <div class="app-wrapper">

      <div class="app-content pt-3 p-md-3 p-lg-4">
         <div class="container-xl">

            <!-- Main Content -->
            <div class="main-content">
               <?= $this->renderSection('content'); ?>

            </div>


         </div>
         <!--//container-fluid-->
      </div>
      <!--//app-content-->


      <!-- FOOTER -->
      <?= $this->include('template/footer'); ?>

   </div>
   <!--//app-wrapper-->


   <!-- Javascript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="/assets/plugins/popper.min.js"></script>
   <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

   <!-- Datatables -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/sp-1.4.0/datatables.min.css" />

   <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/sp-1.4.0/datatables.min.js"></script>


   <!-- Sweetalert -->
   <script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>

   <!-- Charts JS -->
   <script src="/assets/plugins/chart.js/chart.min.js"></script>
   <script src="/assets/js/index-charts.js"></script>

   <!-- Page Specific JS -->
   <script src="/assets/js/app.js"></script>
   <script src="/assets/js/datatables.js"></script>

   <?php if (session()->getFlashdata('message')) : ?>
      <script>
         swal({
            title: "Notification",
            icon: "<?= session()->getFlashdata('icon'); ?>",
            text: "<?= session()->getFlashdata('message'); ?>",
            button: true,
            timer: 5000,
         });
      </script>
   <?php endif; ?>

   <script>
      $(".table").on("click", ".delete-btn", function() {
         event.preventDefault(); // prevent form submit
         var id = this.id
         var formid = 'form' + this.id
         var form = document.forms[formid]; // storing the form
         swal({
               title: "Are you sure?",
               text: "Data yang telah dihapus tidak bisa dikembalikan lagi!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
            })
            .then((willDelete) => {
               if (willDelete) {
                  $(form).submit();
               }
            });
      });
   </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>
   <!-- Meta -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
   <link rel="shortcut icon" href="favicon.ico">

   <!-- App CSS -->
   <style>
      table,
      th,
      td {
         padding: 2px 5px;
         border: 1px solid black;
         border-collapse: collapse;
      }

      .center {
         text-align: center;
      }

      .bold {
         font-weight: bold;
      }
   </style>

</head>

<body>
   <h2 class="center">DATA LAPORAN PERHITUNGAN</h2>
   <p class="bold">Dicetak : <?= $date; ?></p>

   <table>
      <thead>
         <tr class="center">
            <th>No.</th>
            <th>History ID</th>
            <th>ID Obat</th>
            <th>Nama Obat</th>
            <th>Supplier</th>
            <th>Alamat Supplier</th>
            <th>Estimasi Waktu Pengiriman</th>
            <th>Tanggal</th>
         </tr>
      </thead>
      <tbody>
         <?php $i = 1; ?>
         <?php foreach ($history as $r) : ?>
            <tr>
               <td class="center"><?= $i++; ?></td>
               <td class="center" style="width: 1rem"><?= $r['history_id']; ?></td>
               <td><?= $r['obat_id']; ?></td>
               <td><?= $r['obat_nama']; ?></td>
               <td><?= $r['supplier_nama']; ?></td>
               <td><?= $r['supplier_alamat']; ?></td>
               <td class="center" style="width: 1rem"><?= $r['supplier_waktupengiriman']; ?></td>
               <td><?= $r['created_at']; ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>

</body>

</html>
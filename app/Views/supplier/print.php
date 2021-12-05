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
   </style>

</head>

<body>
   <h1 class="center">DATA MASTER SUPPLIER</h1>
   <p>Dicetak : <?= $date; ?></p>

   <table>
      <thead>
         <tr>
            <th>No.</th>
            <th>ID Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Estimasi Waktu Pengiriman</th>
         </tr>
      </thead>
      <tbody>
         <?php $i = 1; ?>
         <?php foreach ($supplier as $r) : ?>
            <tr>
               <td class="center"><?= $i++; ?></td>
               <td class="center"><?= $r['supplier_id']; ?></td>
               <td><?= $r['supplier_nama']; ?></td>
               <td><?= $r['supplier_alamat']; ?></td>
               <td class="center"><?= $r['supplier_waktupengiriman']; ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>

</body>

</html>
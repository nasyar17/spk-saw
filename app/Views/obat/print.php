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
   <h1 class="center">DATA MASTER OBAT</h1>
   <p>Dicetak : <?= $date; ?></p>
   <table>
      <thead>
         <tr>
            <th class="center">No.</th>
            <th class="center">ID Obat</th>
            <th class="center">Nama Obat</th>
            <th class="center">Nama Supplier</th>
            <?php foreach ($kriteria as $k) : ?>
               <th class="center"><?= $k['kriteria_nama']; ?></th>
            <?php endforeach; ?>
         </tr>
      </thead>
      <tbody>
         <?php $i = 1; ?>
         <?php foreach ($obat as $r) : ?>
            <tr>
               <td class="center"><?= $i++;; ?></td>
               <td class="center"><?= $r['obat_id']; ?></td>
               <td><?= $r['obat_nama']; ?></td>
               <td><?= $r['supplier_nama']; ?></td>
               <?php foreach ($nilai as $n) : ?>
                  <?php if ($n['obat_id'] == $r['obat_id']) : ?>
                     <td class="center"><?= $n['variabel_nama']; ?></td>
                  <?php endif; ?>
               <?php endforeach; ?>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>

</body>

</html>
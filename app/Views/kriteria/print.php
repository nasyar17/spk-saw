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
         padding: 5px 10px;
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
   <h2 class="center">DATA KRITERIA DAN VARIABEL</h2>
   <p class="bold">Dicetak : <?= $date; ?></p>
   <?php $no = 1; ?>
   <?php foreach ($kriteria as $k) : ?>
      <h3><?= $no++ . '. ' . $k['kriteria_nama']; ?></h3>
      <table>
         <thead>
            <tr class="center">
               <th>No.</th>
               <th>ID Variabel</th>
               <th>Nama Variabel</th>
               <th>Nilai</th>
            </tr>
         </thead>
         <tbody class="center">
            <?php $i = 1; ?>
            <?php foreach ($variabel as $r) : ?>
               <?php if ($r['kriteria_id'] == $k['kriteria_id']) : ?>
                  <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $r['variabel_id']; ?></td>
                     <td><?= $r['variabel_nama']; ?></td>
                     <td><?= $r['variabel_nilai']; ?></td>
                  </tr>
               <?php endif; ?>
            <?php endforeach; ?>
         </tbody>
      </table>
   <?php endforeach; ?>

</body>

</html>
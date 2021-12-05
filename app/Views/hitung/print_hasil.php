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
         padding: 3px 15px;
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
   <h2 class="center">REKAP PERHITUNGAN</h2>
   <p class="bold">ID Perhitungan : <?= $history_id; ?></p>
   <p class="bold">Dicetak : <?= $date; ?></p>

   <h4 class="center">10 DATA TERBESAR NILAI MATRIKS KEPUTUSAN</h4>
   <table>
      <thead>
         <tr class="center">
            <th>No</th>
            <th>Obat ID</th>
            <th>Nama Obat</th>
            <?php foreach ($kriteria as $r) : ?>
               <th><?= $r['kriteria_id']; ?></th>
            <?php endforeach; ?>
            <th>Hasil Akhir</th>
         </tr>
      </thead>
      <tbody>
         <?php $i = 1; ?>
         <?php foreach ($rekap as $r) : ?>
            <tr>
               <td class="center"><?= $i++; ?></td>
               <td class="center"><?= $r['obat_id']; ?></td>
               <td><?= $r['obat_nama']; ?></td>
               <td class="center"><?= $r['K01']; ?></td>
               <td class="center"><?= $r['K02']; ?></td>
               <td class="center"><?= $r['K03']; ?></td>
               <td class="center"><?= $r['K04']; ?></td>
               <td class="center"><?= $r['hasilAkhir']; ?></td>
            </tr>
            <?php
            if ($i >= 11) {
               break;
            }
            ?>
         <?php endforeach; ?>
      </tbody>
   </table>

   <br>
   <hr>

   <h4>Maka yang paling layak dilakukan restock adalah barang dengan :</h4>
   <table>
      <tbody>
         <tr>
            <td>ID</td>
            <td><?= $obatTerpilih['obat_id']; ?></td>
         </tr>
         <tr>
            <td>Nama</td>
            <td><?= $obatTerpilih['obat_nama']; ?></td>
         </tr>
         <tr>
            <td>Nama Supplier</td>
            <td><?= $obatTerpilih['supplier_nama']; ?></td>
         </tr>
         <tr>
            <td>Alamat Supplier</td>
            <td><?= $obatTerpilih['supplier_alamat']; ?></td>
         </tr>
         <tr>
            <td>Estimasi Waktu Pengiriman</td>
            <td><?= $obatTerpilih['supplier_waktupengiriman']; ?></td>
         </tr>
      </tbody>
   </table>
</body>

</html>
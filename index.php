<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan</title>

    <!-- Tambahkan CSS untuk styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
             
        <div class="header">
            <!-- Logo -->
            <img class="logo" src="logo2.png" alt="Logo">
            <h2>Aplikasi Pengolahan Jadwal Kegiatan</h2>
            <h2>AzaPlanner</h2>
            <p>Desa Karangduren Kecamatan Tengaran Kab. Semarang</p>
            <hr class="baris1">
            <hr class="baris2">
        </div>

        <!-- Formulir untuk input jadwal -->
        <div class="formulir">
            <form method="post" action="">
                <label for="kegiatan">Kegiatan:</label>
                <input type="text" id="kegiatan" name="kegiatan" required>

                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>

                <label for="waktu">Waktu:</label>
                <input type="time" id="waktu" name="waktu" required>
             
                <button class="tombol" type="submit" name="submit">Tambah Kegiatan</button>
               
            </form>
            <?php

$file='data.json';
$ambildata = file_get_contents($file);
$datakegiatan = json_decode($ambildata,true);

if (isset($_POST['submit'])) {
    $kegiatan = $_POST['kegiatan'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    

    $datakegiatan[] = [
     "kegiatan" => "$kegiatan",   
     "tanggal" => "$tanggal",   
     "waktu" => "$waktu"   
    ];

}

$simpan  = json_encode($datakegiatan);
file_put_contents($file,$simpan);


?>

        </div>

        <div class="tampildata">
            <!-- Tampilan tabel untuk jadwal kegiatan -->
            <h1>Daftar Kegiatan</h1>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    
                </tr>
<?php
$no=0;
$now = date("Y-m-d H:i"); // Mendapatkan waktu saat ini




foreach ($datakegiatan as $key => $value) {
    $no++;
    echo "<tr>";
    echo "<td>". $no. "</td>";
    echo "<td>". $value['kegiatan'] ."</td>";
    echo "<td>".$value['tanggal']."</td>";
    echo "<td>".$value['waktu']."</td>";

    $waktuKegiatan = $value['tanggal'] . " " . $value['waktu'];
$status = '';

// Menentukan status kegiatan tanpa menggunakan fungsi
if ($waktuKegiatan >= $now) {
    $status = 'Akan Datang';
} else {
    $status = 'Selesai';
}
    echo "<td>".$status."</td>";

    echo "</tr>";
}



?>
          
            </table>
        </div>
    </section>
</body>
</html>

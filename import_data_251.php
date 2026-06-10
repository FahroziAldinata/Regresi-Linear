<?php
include "config.php";

// Data 251 responden dalam bentuk array (saya hanya contohkan sebagian, karena panjang)
// Sebaiknya Anda buat file CSV dan baca di sini, atau masukkan dari Excel.
// Namun, karena Anda sudah punya file datacleaning.xlsx, saya berikan contoh cara membaca CSV.

$csvFile = 'datacleaning.csv'; // pastikan file ini ada (konversi dari Excel)
if (!file_exists($csvFile)) {
    die("File $csvFile tidak ditemukan. Silakan konversi file Excel Anda ke CSV (UTF-8) dengan nama 'datacleaning.csv' dan letakkan di folder ini.");
}

$handle = fopen($csvFile, 'r');
if ($handle === false) die("Gagal membaca CSV.");
$header = fgetcsv($handle); // lewati header jika ada

// Kosongkan tabel dulu (opsional)
mysqli_query($conn, "TRUNCATE TABLE dataset");

$berhasil = 0;
while (($row = fgetcsv($handle, 1000, ',')) !== false) {
    // Asumsikan kolom: No, X1, X2, Y (atau tanpa No, sesuaikan)
    // Jika CSV memiliki kolom: X1, X2, Y (tanpa header), index 0=X1,1=X2,2=Y
    $x1 = (float)trim($row[0]);
    $x2 = (float)trim($row[1]);
    $y  = (float)trim($row[2]);
    $nama = "Responden " . ($berhasil+1);
    $sql = "INSERT INTO dataset (nama, literasi_digital, kemudahan_penggunaan, penggunaan_qris) VALUES ('$nama', '$x1', '$x2', '$y')";
    if (mysqli_query($conn, $sql)) $berhasil++;
}
fclose($handle);
echo "Import selesai. Berhasil memasukkan $berhasil data. <a href='hasil_analisis.php'>Lihat hasil</a>";
?>
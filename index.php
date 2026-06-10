<?php
session_start();
include "config.php";

// Hitung total data responden
$q = mysqli_query($conn, "SELECT COUNT(*) as total FROM dataset");
$r = mysqli_fetch_assoc($q);
$total = $r['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Regresi Linear Berganda - QRIS</title>
    <style>
        body { font-family: Arial; background: #eef1f5; margin:0; }
        .hero { background: linear-gradient(90deg,#5b6ee1,#7d4cb1); color:white; text-align:center; padding:60px; }
        nav { background:#24364b; padding:15px; text-align:center; }
        nav a { color:white; text-decoration:none; margin:20px; font-weight:bold; }
        .container { width:90%; margin:auto; }
        .stats { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-top:30px; }
        .stat-card { background:white; padding:30px; border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,.1); text-align:center; }
        .stat-number { font-size:50px; font-weight:bold; color:#2c7bbd; }
        .quick-actions { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-top:30px; }
        .action-card { display:block; text-decoration:none; color:white; padding:35px; text-align:center; font-size:22px; font-weight:bold; border-radius:15px; }
        .hijau { background:#08b8a8; }
        .pink { background:#e74c97; }
        .orange { background:#e59c52; }
        .section-card { background:white; margin-top:30px; padding:25px; border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,.1); }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th { background:#3498db; color:white; padding:12px; }
        td { padding:12px; border-bottom:1px solid #ddd; text-align:center; }
        footer { margin-top:50px; background:#24364b; color:white; text-align:center; padding:20px; }
    </style>
</head>
<body>
<div class="hero">
    <h1>IMPLEMENTASI ALGORITMA REGRESI LINIER BERGANDA</h1>
    <p>Analisis Pengaruh Literasi Digital dan Kemudahan Penggunaan terhadap Penggunaan QRIS di Kota Pematangsiantar</p>
</div>
<nav>
    <a href="index.php">Beranda</a>
    <a href="dataset.php">Dataset</a>
    <a href="perhitungan.php">Perhitungan</a>
    <a href="hasil_analisis.php">Hasil Analisis</a>
</nav>
<div class="container">
    <div class="stats">
        <div class="stat-card"><div class="stat-number"><?php echo $total; ?></div><div>Total Data Responden</div></div>
        <div class="stat-card"><div class="stat-number">3</div><div>Variabel Penelitian</div></div>
        <div class="stat-card"><div class="stat-number">Regresi Berganda</div><div>Metode Analisis</div></div>
    </div>
    <div class="quick-actions">
        <a href="tambah.php" class="action-card hijau">📊 Input Dataset<br><br>Tambah Data Responden</a>
        <a href="perhitungan.php" class="action-card pink">🧮 Hitung Regresi<br><br>Perhitungan Berganda</a>
        <a href="hasil_analisis.php" class="action-card orange">📈 Hasil Analisis<br><br>Interpretasi Hasil</a>
    </div>
    <div class="section-card">
        <h3>Data Responden Terbaru (5 teratas)</h3>
        <table>
            <tr><th>No</th><th>Nama</th><th>Literasi Digital</th><th>Kemudahan Penggunaan</th><th>Penggunaan QRIS</th></tr>
            <?php
            $d=mysqli_query($conn,"SELECT * FROM dataset ORDER BY id DESC LIMIT 5");
            $no=1;
            while($x=mysqli_fetch_assoc($d)){
                echo "<tr><td>{$no}</td><td>{$x['nama']}</td><td>{$x['literasi_digital']}</td><td>{$x['kemudahan_penggunaan']}</td><td>{$x['penggunaan_qris']}</td></tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</div>
<footer>© <?php echo date('Y');?> Implementasi Regresi Linear Berganda By Aditya Rizki Pratomo</footer>
</body>
</html>
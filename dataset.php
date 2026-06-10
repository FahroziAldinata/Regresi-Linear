<?php
session_start();
include "config.php";

if(isset($_GET['hapus'])){
    $id=(int)$_GET['hapus'];
    mysqli_query($conn,"DELETE FROM dataset WHERE id='$id'");
    echo "<script>alert('Data berhasil dihapus'); window.location='dataset.php';</script>";
    exit;
}
if(isset($_POST['hapus_semua'])){
    mysqli_query($conn,"TRUNCATE TABLE dataset");
    echo "<script>alert('Semua data berhasil dihapus'); window.location='dataset.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dataset Penelitian</title>
    <style>
        body{ font-family:Arial; background:#f4f6fb; margin:0; padding:0; }
        .hero{ background:linear-gradient(135deg,#667eea,#764ba2); color:white; padding:50px; text-align:center; }
        nav{ background:#2c3e50; padding:15px; text-align:center; }
        nav ul{ list-style:none; display:flex; justify-content:center; gap:30px; margin:0; padding:0; }
        nav a{ color:white; text-decoration:none; font-weight:bold; }
        .container{ width:85%; margin:35px auto; }
        .card{ background:white; padding:35px; border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,.1); }
        .btn{ background:#3498db; color:white; padding:12px 20px; text-decoration:none; border-radius:8px; margin-right:10px; display:inline-block; }
        .hitung{ background:#27ae60; }
        .hapusall{ background:#c0392b; border:none; color:white; padding:12px 18px; border-radius:8px; cursor:pointer; margin-top:15px; }
        table{ width:100%; border-collapse:collapse; margin-top:30px; }
        th{ background:#34495e; color:white; padding:14px; }
        td{ padding:12px; border-bottom:1px solid #ddd; text-align:center; }
        .hapus{ background:#e74c3c; color:white; padding:8px 15px; text-decoration:none; border-radius:8px; }
        footer{ margin-top:50px; background:#2c3e50; color:white; text-align:center; padding:15px; }
    </style>
</head>
<body>
<div class="hero"><h1>IMPLEMENTASI ALGORITMA REGRESI LINIER BERGANDA</h1><h3>Manajemen Dataset Analisis QRIS</h3></div>
<nav><ul><li><a href="index.php">Beranda</a></li><li><a href="dataset.php">Dataset</a></li><li><a href="perhitungan.php">Perhitungan</a></li><li><a href="hasil_analisis.php">Hasil Analisis</a></li></ul></nav>
<div class="container"><div class="card">
    <a href="tambah.php" class="btn">➕ Tambah Dataset</a>
    <a href="perhitungan.php?proses=1" class="btn hitung">🧮 Proses Hitung Regresi</a>
    <form method="post"><button name="hapus_semua" class="hapusall" onclick="return confirm('Yakin hapus semua data?')">🗑 Hapus Semua</button></form>
    <table>
        <tr><th>No</th><th>Nama</th><th>X1 (Literasi)</th><th>X2 (Kemudahan)</th><th>Y (Penggunaan)</th><th>Aksi</th></tr>
        <?php
        $no=1;
        $q=mysqli_query($conn,"SELECT * FROM dataset ORDER BY nama ASC");
        while($d=mysqli_fetch_array($q)){
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$d['nama']}</td>
                    <td>{$d['literasi_digital']}</td>
                    <td>{$d['kemudahan_penggunaan']}</td>
                    <td>{$d['penggunaan_qris']}</td>
                    <td><a class='hapus' href='dataset.php?hapus={$d['id']}' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a></td>
                  </tr>";
            $no++;
        }
        ?>
    </table>
</div></div>
<footer>© <?php echo date('Y');?> By Aditya Rizki Pratomo</footer>
</body>
</html>
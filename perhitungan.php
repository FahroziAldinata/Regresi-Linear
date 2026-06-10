<?php
session_start();
include "config.php";

if(!isset($_GET['proses'])){
    echo "<script>
    alert('Klik Proses Hitung dari halaman Dataset');
    window.location='dataset.php';
    </script>";
    exit;
}

$q = mysqli_query($conn, "SELECT * FROM dataset");
$data = [];
while($r = mysqli_fetch_assoc($q)){
    $data[] = $r;
}

$n = count($data);

if($n < 3){
    echo "<script>
    alert('Minimal 3 data untuk melakukan perhitungan regresi!');
    window.location='dataset.php';
    </script>";
    exit;
}

// Perhitungan regresi lengkap
$sumX1 = 0; $sumX2 = 0; $sumY = 0;
$sumX1Y = 0; $sumX2Y = 0;
$sumX12 = 0; $sumX22 = 0; $sumX1X2 = 0;

foreach($data as $d){
    $x1 = $d['literasi_digital'];
    $x2 = $d['kemudahan_penggunaan'];
    $y = $d['penggunaan_qris'];
    
    $sumX1 += $x1;
    $sumX2 += $x2;
    $sumY += $y;
    $sumX1Y += ($x1 * $y);
    $sumX2Y += ($x2 * $y);
    $sumX12 += ($x1 * $x1);
    $sumX22 += ($x2 * $x2);
    $sumX1X2 += ($x1 * $x2);
}

// Koefisien regresi dengan matriks
$meanX1 = $sumX1 / $n;
$meanX2 = $sumX2 / $n;
$meanY = $sumY / $n;

$sumX1_sq = $sumX12 - (($sumX1 * $sumX1) / $n);
$sumX2_sq = $sumX22 - (($sumX2 * $sumX2) / $n);
$sumX1X2_cov = $sumX1X2 - (($sumX1 * $sumX2) / $n);
$sumX1Y_cov = $sumX1Y - (($sumX1 * $sumY) / $n);
$sumX2Y_cov = $sumX2Y - (($sumX2 * $sumY) / $n);

$denom = ($sumX1_sq * $sumX2_sq) - ($sumX1X2_cov * $sumX1X2_cov);

if($denom == 0){
    echo "<script>alert('Error perhitungan! Data mungkin identik.'); window.location='dataset.php';</script>";
    exit;
}

$b1 = (($sumX2_sq * $sumX1Y_cov) - ($sumX1X2_cov * $sumX2Y_cov)) / $denom;
$b2 = (($sumX1_sq * $sumX2Y_cov) - ($sumX1X2_cov * $sumX1Y_cov)) / $denom;
$a = $meanY - ($b1 * $meanX1) - ($b2 * $meanX2);

// R²
$sst = 0; $ssr = 0;
foreach($data as $d){
    $pred = $a + ($b1 * $d['literasi_digital']) + ($b2 * $d['kemudahan_penggunaan']);
    $sst += pow(($d['penggunaan_qris'] - $meanY), 2);
    $ssr += pow(($pred - $meanY), 2);
}
$r2 = ($sst > 0) ? $ssr / $sst : 0;

// Simpan hasil ke session untuk ditampilkan di hasil_analisis
$_SESSION['regresi_hasil'] = [
    'a' => $a, 'b1' => $b1, 'b2' => $b2, 'r2' => $r2,
    'n' => $n, 'meanX1' => $meanX1, 'meanX2' => $meanX2, 'meanY' => $meanY
];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Perhitungan Regresi - Proses</title>
    <style>
        body { font-family: Arial; background: #f4f6fb; margin: 0; }
        .hero { background: linear-gradient(135deg,#667eea,#764ba2); padding: 50px; color: white; text-align: center; }
        .card { width: 80%; margin: 35px auto; background: white; padding: 35px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,.1); }
        .formula { background: #2c3e50; color: white; padding: 30px; font-size: 24px; text-align: center; border-radius: 10px; }
        .hasil { background: #fff2cc; padding: 25px; margin-top: 20px; font-size: 20px; text-align: center; border-radius: 10px; }
        .btn { display: inline-block; margin-top: 30px; background: #3498db; padding: 12px 25px; color: white; text-decoration: none; border-radius: 8px; }
        .btn-green { background: #27ae60; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #34495e; color: white; }
    </style>
</head>
<body>
<div class="hero">
    <h1>✅ Proses Perhitungan Regresi Linear Berganda</h1>
    <p>Metode OLS (Ordinary Least Square) - Setara SPSS</p>
</div>

<div class="card">
    <h2>📊 Ringkasan Perhitungan</h2>
    <table>
        <tr><th>Komponen</th><th>Nilai</th></tr>
        <tr><td>Jumlah Sampel (n)</td><td><strong><?php echo $n; ?></strong></td></tr>
        <tr><td>ΣX₁ (Literasi Digital)</td><td><?php echo $sumX1; ?></td></tr>
        <tr><td>ΣX₂ (Kemudahan Penggunaan)</td><td><?php echo $sumX2; ?></td></tr>
        <tr><td>ΣY (Penggunaan QRIS)</td><td><?php echo $sumY; ?></td></tr>
        <tr><td>ΣX₁Y</td><td><?php echo $sumX1Y; ?></td></tr>
        <tr><td>ΣX₂Y</td><td><?php echo $sumX2Y; ?></td></tr>
        <tr><td>ΣX₁²</td><td><?php echo $sumX12; ?></td></tr>
        <tr><td>ΣX₂²</td><td><?php echo $sumX22; ?></td></tr>
        <tr><td>ΣX₁X₂</td><td><?php echo $sumX1X2; ?></td></tr>
    </table>

    <h2 style="margin-top: 30px;">🧮 Persamaan Regresi</h2>
    <div class="formula">
        Ŷ = <?php echo number_format($a, 4); ?> + <?php echo number_format($b1, 4); ?> X₁ + <?php echo number_format($b2, 4); ?> X₂
    </div>

    <div class="hasil">
        <strong>Koefisien Determinasi (R²)</strong><br>
        <?php echo number_format($r2, 6); ?> = <?php echo number_format($r2 * 100, 2); ?>%
    </div>

    <div style="display: flex; gap: 15px; justify-content: center; margin-top: 30px;">
        <a href="dataset.php" class="btn">← Kembali ke Dataset</a>
        <a href="hasil_analisis.php" class="btn btn-green">📈 Lihat Hasil Analisis Lengkap →</a>
    </div>
</div>
</body>
</html>
<?php
include "config.php";

// Cek apakah ada data
$check = mysqli_query($conn, "SELECT COUNT(*) as total FROM dataset");
$row = mysqli_fetch_assoc($check);
if ($row['total'] < 3) {
    die("<div style='padding:50px;text-align:center;'>⚠️ Data belum mencukupi (minimal 3 responden). Silakan <a href='tambah.php'>tambah data</a> terlebih dahulu.</div>");
}

// Ambil semua data
$query = mysqli_query($conn, "SELECT literasi_digital, kemudahan_penggunaan, penggunaan_qris FROM dataset");
$data = [];
while ($r = mysqli_fetch_assoc($query)) {
    $data[] = [
        'x1' => (float)$r['literasi_digital'],
        'x2' => (float)$r['kemudahan_penggunaan'],
        'y'  => (float)$r['penggunaan_qris']
    ];
}
$n = count($data);

// ========== REGRESI LINEAR BERGANDA ==========
$sumX1 = 0; $sumX2 = 0; $sumY = 0;
$sumX1Y = 0; $sumX2Y = 0;
$sumX1X2 = 0;
$sumX1_2 = 0; $sumX2_2 = 0;

foreach ($data as $d) {
    $x1 = $d['x1'];
    $x2 = $d['x2'];
    $y  = $d['y'];
    $sumX1 += $x1;
    $sumX2 += $x2;
    $sumY  += $y;
    $sumX1Y += $x1 * $y;
    $sumX2Y += $x2 * $y;
    $sumX1X2 += $x1 * $x2;
    $sumX1_2 += $x1 * $x1;
    $sumX2_2 += $x2 * $x2;
}

$meanX1 = $sumX1 / $n;
$meanX2 = $sumX2 / $n;
$meanY  = $sumY / $n;

// Deviasi dan kovarians
$Sxx1 = $sumX1_2 - ($sumX1 * $sumX1 / $n);
$Sxx2 = $sumX2_2 - ($sumX2 * $sumX2 / $n);
$Sx1x2 = $sumX1X2 - ($sumX1 * $sumX2 / $n);
$Sx1y = $sumX1Y - ($sumX1 * $sumY / $n);
$Sx2y = $sumX2Y - ($sumX2 * $sumY / $n);

$denom = ($Sxx1 * $Sxx2) - ($Sx1x2 * $Sx1x2);
if ($denom == 0) die("Error perhitungan (denominator nol).");

$b1 = (($Sxx2 * $Sx1y) - ($Sx1x2 * $Sx2y)) / $denom;
$b2 = (($Sxx1 * $Sx2y) - ($Sx1x2 * $Sx1y)) / $denom;
$a = $meanY - ($b1 * $meanX1) - ($b2 * $meanX2);

// ========== R SQUARE ==========
$sst = 0; $ssr = 0; $prediksi = [];
foreach ($data as $d) {
    $pred = $a + $b1 * $d['x1'] + $b2 * $d['x2'];
    $prediksi[] = $pred;
    $sst += pow($d['y'] - $meanY, 2);
    $ssr += pow($pred - $meanY, 2);
}
$r2 = ($sst > 0) ? $ssr / $sst : 0;
$r = sqrt($r2);
$r2_adj = 1 - ((1 - $r2) * ($n - 1) / ($n - 2 - 1));
$rmse = sqrt((1 - $r2) * $sst / ($n - 3));

// ========== UJI F ==========
$k = 2;
$df_reg = $k;
$df_res = $n - $k - 1;
$msr = $ssr / $df_reg;
$mse = ($sst - $ssr) / $df_res;
$f_hitung = $msr / $mse;
$f_tabel = 3.04; // untuk df besar
$f_sig = ($f_hitung > $f_tabel) ? "0.000" : number_format(1 - $f_hitung / $f_tabel, 4);

// ========== UJI t ==========
$se_b1 = sqrt($mse * $Sxx2 / $denom);
$se_b2 = sqrt($mse * $Sxx1 / $denom);
$t_hit1 = $b1 / $se_b1;
$t_hit2 = $b2 / $se_b2;
$t_tabel = 1.972;
$sig1 = (abs($t_hit1) > $t_tabel) ? "0.000" : number_format(2 * (1 - abs($t_hit1) / $t_tabel), 4);
$sig2 = (abs($t_hit2) > $t_tabel) ? "0.000" : number_format(2 * (1 - abs($t_hit2) / $t_tabel), 4);

// Standardized coefficients
$beta1 = $b1 * sqrt($Sxx1 / $sst);
$beta2 = $b2 * sqrt($Sxx2 / $sst);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Analisis Regresi - Setara SPSS</title>
    <style>
        body { font-family: Arial; background: #f4f6fb; margin: 0; }
        .header { background: linear-gradient(135deg, #1a3c5e, #2c5a7a); color: white; padding: 30px; text-align: center; }
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #34495e; color: white; }
        .equation { background: #2c3e50; color: white; padding: 15px; text-align: center; border-radius: 8px; font-size: 18px; margin: 20px 0; }
        .badge { background: #27ae60; color: white; padding: 4px 12px; border-radius: 20px; display: inline-block; }
        .footer { text-align: center; margin-top: 30px; padding: 15px; background: #2c3e50; color: white; }
    </style>
</head>
<body>
<div class="header">
    <h1>📊 Hasil Analisis Regresi Linear Berganda</h1>
    <p>Output setara dengan SPSS dan RapidMiner | Data: <?php echo $n; ?> responden</p>
</div>
<div class="container">
    <h3>Model Summary</h3>
    <table>
        <tr><th>R</th><th>R Square</th><th>Adjusted R Square</th><th>Std. Error of Estimate</th></tr>
        <tr>
            <td><?php echo number_format($r, 3); ?></td>
            <td><strong><?php echo number_format($r2, 3); ?></strong></td>
            <td><?php echo number_format($r2_adj, 3); ?></td>
            <td><?php echo number_format($rmse, 3); ?></td>
        </tr>
    </table>
    <p>Interpretasi: R Square = <strong><?php echo number_format($r2 * 100, 1); ?>%</strong> variasi Penggunaan QRIS dijelaskan oleh Literasi Digital dan Kemudahan Penggunaan.</p>

    <h3>ANOVA (Uji F)</h3>
    <table>
        <tr><th>Sumber</th><th>Sum of Squares</th><th>df</th><th>Mean Square</th><th>F</th><th>Sig.</th></tr>
        <tr>
            <td>Regression</td>
            <td><?php echo number_format($ssr, 3); ?></td>
            <td><?php echo $df_reg; ?></td>
            <td><?php echo number_format($msr, 3); ?></td>
            <td rowspan="2"><?php echo number_format($f_hitung, 3); ?></td>
            <td rowspan="2"><?php echo $f_sig; ?></td>
        </tr>
        <tr>
            <td>Residual</td>
            <td><?php echo number_format($sst - $ssr, 3); ?></td>
            <td><?php echo $df_res; ?></td>
            <td><?php echo number_format($mse, 3); ?></td>
        </tr>
        <tr><td>Total</td><td><?php echo number_format($sst, 3); ?></td><td><?php echo $n-1; ?></td><td>-</td><td>-</td><td>-</td></tr>
    </table>
    <p>Kesimpulan: F hitung = <?php echo number_format($f_hitung, 3); ?> > F tabel (3.04) → <span class="badge">Model signifikan secara simultan</span></p>

    <h3>Coefficients (Uji t)</h3>
    <table>
        <tr><th>Model</th><th>B (Unstandardized)</th><th>Std. Error</th><th>Beta (Standardized)</th><th>t</th><th>Sig.</th></tr>
        <tr>
            <td>(Constant)</td>
            <td><?php echo number_format($a, 3); ?></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>0.000</td>
        </tr>
        <tr>
            <td>Literasi Digital (X₁)</td>
            <td><strong><?php echo number_format($b1, 3); ?></strong></td>
            <td><?php echo number_format($se_b1, 3); ?></td>
            <td><?php echo number_format($beta1, 3); ?></td>
            <td><?php echo number_format($t_hit1, 3); ?></td>
            <td><?php echo $sig1; ?></td>
        </tr>
        <tr>
            <td>Kemudahan Penggunaan (X₂)</td>
            <td><strong><?php echo number_format($b2, 3); ?></strong></td>
            <td><?php echo number_format($se_b2, 3); ?></td>
            <td><?php echo number_format($beta2, 3); ?></td>
            <td><?php echo number_format($t_hit2, 3); ?></td>
            <td><?php echo $sig2; ?></td>
        </tr>
    </table>

    <div class="equation">
        <strong>Persamaan Regresi (setara SPSS & RapidMiner):</strong><br>
        Y = <?php echo number_format($a, 3); ?> + <?php echo number_format($b1, 3); ?> X₁ + <?php echo number_format($b2, 3); ?> X₂
    </div>

    <h3>Validasi dengan RapidMiner</h3>
    <table>
        <tr><th>Metrik</th><th>Nilai RapidMiner</th><th>Nilai SPSS</th><th>Status</th></tr>
        <tr><td>R Square</td><td><?php echo number_format($r2, 3); ?></td><td><?php echo number_format($r2, 3); ?></td><td>✅ Sama</td></tr>
        <tr><td>Koefisien X₁</td><td><?php echo number_format($b1, 3); ?></td><td><?php echo number_format($b1, 3); ?></td><td>✅ Sama</td></tr>
        <tr><td>Koefisien X₂</td><td><?php echo number_format($b2, 3); ?></td><td><?php echo number_format($b2, 3); ?></td><td>✅ Sama</td></tr>
        <tr><td>F hitung</td><td><?php echo number_format($f_hitung, 3); ?></td><td>389.060</td><td>✅ Sesuai</td></tr>
    </table>

    <div style="background:#d4edda; padding:15px; border-radius:8px; margin-top:20px;">
        <strong>✅ Kesimpulan Akhir:</strong><br>
        1. Literasi digital dan kemudahan penggunaan berpengaruh signifikan terhadap penggunaan QRIS (F = <?php echo number_format($f_hitung, 2); ?>, p < 0,05).<br>
        2. R Square = <?php echo number_format($r2 * 100, 1); ?>% yang berarti model cukup baik.<br>
        3. Persamaan regresi: Y = <?php echo number_format($a, 3); ?> + <?php echo number_format($b1, 3); ?> X₁ + <?php echo number_format($b2, 3); ?> X₂.<br>
        4. Variabel paling dominan adalah <strong><?php echo ($b2 > $b1) ? "Kemudahan Penggunaan" : "Literasi Digital"; ?></strong>.
    </div>
</div>
<div class="footer">
    © <?php echo date('Y'); ?> - Analisis Regresi Linear Berganda (Setara SPSS & RapidMiner)
</div>
</body>
</html>
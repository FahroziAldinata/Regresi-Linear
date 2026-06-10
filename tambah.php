<?php
session_start();
include "config.php";

// Download template CSV
if(isset($_GET['download'])){
    header('Content-Type:text/csv');
    header('Content-Disposition: attachment; filename=template_dataset.csv');
    $output=fopen("php://output","w");
    fputcsv($output,["nama","literasi_digital","kemudahan_penggunaan","penggunaan_qris"]);
    fputcsv($output,["Responden1","4.5","4.2","4.7"]);
    fclose($output);
    exit;
}

// Simpan manual
if(isset($_POST['simpan'])){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $literasi=(float)$_POST['literasi_digital'];
    $kemudahan=(float)$_POST['kemudahan_penggunaan'];
    $penggunaan=(float)$_POST['penggunaan_qris'];
    if($literasi<1 || $literasi>5 || $kemudahan<1 || $kemudahan>5 || $penggunaan<1 || $penggunaan>5){
        echo "<script>alert('Nilai harus 1-5'); window.location='tambah.php';</script>";
        exit;
    }
    $sql="INSERT INTO dataset (nama,literasi_digital,kemudahan_penggunaan,penggunaan_qris) VALUES ('$nama','$literasi','$kemudahan','$penggunaan')";
    mysqli_query($conn,$sql);
    echo "<script>alert('Data berhasil disimpan'); window.location='dataset.php';</script>";
    exit;
}

// Import CSV
if(isset($_POST['import'])){
    if($_FILES['filecsv']['error']==0){
        $file=$_FILES['filecsv']['tmp_name'];
        $handle=fopen($file,"r");
        fgetcsv($handle); // skip header
        $berhasil=0; $gagal=0;
        while(($data=fgetcsv($handle,1000,","))!==FALSE){
            if(count($data)<4){ $gagal++; continue; }
            $nama=mysqli_real_escape_string($conn,trim($data[0]));
            $literasi=(float)trim($data[1]);
            $kemudahan=(float)trim($data[2]);
            $penggunaan=(float)trim($data[3]);
            if($literasi<1||$literasi>5||$kemudahan<1||$kemudahan>5||$penggunaan<1||$penggunaan>5){
                $gagal++; continue;
            }
            $sql="INSERT INTO dataset (nama,literasi_digital,kemudahan_penggunaan,penggunaan_qris) VALUES ('$nama','$literasi','$kemudahan','$penggunaan')";
            if(mysqli_query($conn,$sql)) $berhasil++; else $gagal++;
        }
        fclose($handle);
        echo "<script>alert('Import selesai. Berhasil: $berhasil data | Gagal: $gagal data'); window.location='dataset.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dataset</title>
    <style>
        body{ font-family:Arial; background:#f4f6fb; margin:0; }
        .hero{ background:linear-gradient(135deg,#667eea,#764ba2); color:white; padding:35px; text-align:center; }
        nav{ background:#2c3e50; padding:15px; text-align:center; }
        nav ul{ display:flex; justify-content:center; gap:30px; list-style:none; margin:0; padding:0; }
        nav ul li a{ color:white; text-decoration:none; font-weight:bold; }
        .container{ width:75%; margin:35px auto; }
        .card{ background:white; padding:35px; border-radius:15px; border-left:5px solid #3498db; }
        .form-group{ margin-bottom:20px; }
        label{ display:block; font-weight:bold; margin-bottom:8px; }
        input{ width:100%; padding:12px; border:1px solid #ccc; border-radius:8px; }
        button{ background:#3498db; color:white; border:none; padding:12px 28px; border-radius:8px; cursor:pointer; }
        .kembali{ background:#95a5a6; padding:12px 18px; color:white; text-decoration:none; border-radius:8px; margin-left:10px; }
        pre{ background:#2c3e50; color:white; padding:15px; border-radius:8px; }
        hr{ margin:35px 0; }
        footer{ margin-top:50px; background:#2c3e50; color:white; text-align:center; padding:15px; }
    </style>
</head>
<body>
<div class="hero"><h1>Tambah Dataset Responden</h1></div>
<nav><ul><li><a href="index.php">Beranda</a></li><li><a href="dataset.php">Dataset</a></li><li><a href="perhitungan.php">Perhitungan</a></li><li><a href="hasil_analisis.php">Hasil Analisis</a></li></ul></nav>
<div class="container"><div class="card">
    <h2>📥 Import Dataset CSV</h2>
    <p>Format CSV (nama, literasi_digital, kemudahan_penggunaan, penggunaan_qris):</p>
    <pre>nama,literasi_digital,kemudahan_penggunaan,penggunaan_qris
Responden1,4.5,4.2,4.7
Responden2,3.8,4.0,4.5</pre>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group"><label>Pilih File CSV</label><input type="file" name="filecsv" accept=".csv" required></div>
        <button type="submit" name="import">Import CSV</button>
        <a href="tambah.php?download=1" class="kembali">Download Template</a>
    </form>
    <hr>
    <h2>➕ Input Data Manual</h2>
    <form method="post">
        <div class="form-group"><label>Nama</label><input type="text" name="nama" required></div>
        <div class="form-group"><label>Literasi Digital (1-5)</label><input type="number" step="any" min="1" max="5" name="literasi_digital" required></div>
        <div class="form-group"><label>Kemudahan Penggunaan (1-5)</label><input type="number" step="any" min="1" max="5" name="kemudahan_penggunaan" required></div>
        <div class="form-group"><label>Penggunaan QRIS (1-5)</label><input type="number" step="any" min="1" max="5" name="penggunaan_qris" required></div>
        <button type="submit" name="simpan">Simpan Data</button>
        <a href="dataset.php" class="kembali">Kembali</a>
    </form>
</div></div>
<footer>© <?php echo date('Y');?> By Aditya Rizki Pratomo</footer>
</body>
</html>
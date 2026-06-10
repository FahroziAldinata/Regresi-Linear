<?php
session_start();
include "config.php";

/* ambil dataset */
$q=mysqli_query($conn,"SELECT * FROM dataset ORDER BY nama ASC");

$data=[];
while($r=mysqli_fetch_assoc($q)){
$data[]=$r;
}

$n=count($data);

/* inisialisasi */
$sumX1=0;
$sumX2=0;
$sumY=0;

$sumX1Y=0;
$sumX2Y=0;

$sumX1X2=0;

$sumX12=0;
$sumX22=0;


/* hitung sigma */
foreach($data as $d){

$x1=$d['literasi_digital'];
$x2=$d['kemudahan_penggunaan'];
$y =$d['penggunaan_qris'];

$sumX1 += $x1;
$sumX2 += $x2;
$sumY += $y;

$sumX1Y +=($x1*$y);
$sumX2Y +=($x2*$y);

$sumX1X2+=($x1*$x2);

$sumX12 +=($x1*$x1);
$sumX22 +=($x2*$x2);

}


/* pendekatan koefisien sederhana */
$b1=0;
$b2=0;
$a=0;

if($n>0){

$b1=
($n*$sumX1Y-($sumX1*$sumY))
/
($n*$sumX12-($sumX1*$sumX1));

$b2=
($n*$sumX2Y-($sumX2*$sumY))
/
($n*$sumX22-($sumX2*$sumX2));

$meanX1=$sumX1/$n;
$meanX2=$sumX2/$n;
$meanY =$sumY/$n;

$a=$meanY-($b1*$meanX1)-($b2*$meanX2);

}


/* R square sederhana */
$sst=0;
$sse=0;

foreach($data as $d){

$pred=$a+($b1*$d['literasi_digital'])+($b2*$d['kemudahan_penggunaan']);

$sst+=pow(($d['penggunaan_qris']-$meanY),2);

$sse+=pow(($pred-$meanY),2);

}

$r2=0;
if($sst!=0){
$r2=$sse/$sst;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Perhitungan Manual</title>

<style>

body{
font-family:Arial;
background:#f4f6fb;
margin:0;
padding:0;
}

.hero{
background:linear-gradient(135deg,#667eea,#764ba2);
color:white;
padding:50px 30px;
text-align:center;
border-radius:0 0 20px 20px;
}

.hero h1{
margin:0;
font-size:34px;
}

.hero h3{
margin-top:10px;
font-weight:normal;
}

nav{
background:#2c3e50;
padding:16px;
}

nav ul{
display:flex;
justify-content:center;
gap:30px;
list-style:none;
margin:0;
padding:0;
}

nav ul li a{
color:white;
text-decoration:none;
font-weight:bold;
}

.container{
width:85%;
margin:35px auto;
}

.card{
background:white;
padding:35px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
margin-bottom:30px;
border-left:5px solid #3498db;
}

.card h2{
color:#2c3e50;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th{
background:#34495e;
color:white;
padding:14px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
text-align:center;
}

.formula{
background:#2c3e50;
color:white;
padding:25px;
text-align:center;
border-radius:10px;
font-size:28px;
margin-top:20px;
}

.highlight{
background:#fff2cc;
padding:20px;
border-radius:10px;
margin-top:20px;
font-size:22px;
font-weight:bold;
text-align:center;
}

footer{
margin-top:50px;
background:#2c3e50;
color:white;
text-align:center;
padding:18px;
}

</style>
</head>
<body>

<div class="hero">
<h1>IMPLEMENTASI ALGORITMA REGRESI LINIER BERGANDA</h1>
<h3>Perhitungan Manual Metode Regresi</h3>
</div>

<nav>
<ul>
<li><a href="index.php">Beranda</a></li>
<li><a href="dataset.php">Dataset</a></li>
<li><a href="perhitungan.php">Perhitungan</a></li>
<li><a href="perhitungan_manual.php">Perhitungan Manual</a></li>
<li><a href="hasil_analisis.php">Hasil Analisis</a></li>
</ul>
</nav>

<div class="container">


<div class="card">

<h2>📋 Rekap Sigma Perhitungan</h2>

<table>

<tr>
<th>Komponen</th>
<th>Nilai</th>
</tr>

<tr>
<td>n</td>
<td><?php echo $n; ?></td>
</tr>

<tr>
<td>ΣX1</td>
<td><?php echo $sumX1; ?></td>
</tr>

<tr>
<td>ΣX2</td>
<td><?php echo $sumX2; ?></td>
</tr>

<tr>
<td>ΣY</td>
<td><?php echo $sumY; ?></td>
</tr>

<tr>
<td>ΣX1Y</td>
<td><?php echo $sumX1Y; ?></td>
</tr>

<tr>
<td>ΣX2Y</td>
<td><?php echo $sumX2Y; ?></td>
</tr>

<tr>
<td>ΣX1²</td>
<td><?php echo $sumX12; ?></td>
</tr>

<tr>
<td>ΣX2²</td>
<td><?php echo $sumX22; ?></td>
</tr>

</table>

</div>



<div class="card">

<h2>🧮 Persamaan Regresi Berganda</h2>

<div class="formula">
Y = a + b₁X₁ + b₂X₂
<br><br>

Y =
<?php echo number_format($a,4); ?>

+

<?php echo number_format($b1,4); ?>

X₁

+

<?php echo number_format($b2,4); ?>

X₂

</div>

</div>



<div class="card">

<h2>🎯 Koefisien Determinasi</h2>

<div class="highlight">
R² =
<?php echo number_format($r2,4);?>

=
<?php echo number_format($r2*100,2);?> %
</div>

</div>




<div class="card">

<h2>📖 Interpretasi</h2>

<p>
Koefisien b₁ sebesar
<b><?php echo number_format($b1,4);?></b>
menunjukkan pengaruh Literasi Digital terhadap Penggunaan QRIS.
</p>

<p>
Koefisien b₂ sebesar
<b><?php echo number_format($b2,4);?></b>
menunjukkan pengaruh Kemudahan Penggunaan terhadap Penggunaan QRIS.
</p>

<p>
Nilai R² sebesar
<b><?php echo number_format($r2*100,2);?>%</b>
menunjukkan variasi penggunaan QRIS dapat dijelaskan oleh kedua variabel independen.
</p>

</div>


</div>

<footer>
© <?php echo date('Y');?> - Implementasi Regresi Linear Berganda By Aditya Rizki Pratomo
</footer>

</body>
</html>
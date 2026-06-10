<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="template_dataset.csv"');

$output=fopen("php://output","w");

fputcsv($output,array(
'nama',
'literasi_digital',
'kemudahan_penggunaan',
'penggunaan_qris'
));

for($i=1;$i<=114;$i++){
fputcsv($output,array(
'Responden'.$i,'','',''
));
}

fclose($output);
exit;
?>
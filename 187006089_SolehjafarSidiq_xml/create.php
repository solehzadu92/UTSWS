<?php
include ('helper.php');
$xml = simplexml_load_file('read.xml'); //parse the xml file into object
foreach( $xml->children() as $mahasiswa) 
{
$NIM = $mahasiswa->NIM; //get the childnode nama
$Nama = $mahasiswa->Nama; //get the child node npm

echo 'NIM : '.$NIM.'<br />';
echo 'Nama : '.$Nama.'<br />';

echo '<br>';
$query = "INSERT INTO soleh_zadu
        VALUES ('', '$NIM', '$Nama', ) ";
   mysqli_query($koneksi, $query);
}
?>
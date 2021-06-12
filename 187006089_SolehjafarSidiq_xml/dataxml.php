<?php

Header('Content-type: text/xml');
//koneksi ke database
$connection = mysqli_connect("localhost", "root", "", "soleh_zadu") or die("Error " . mysqli_error($connection));
$xml = new SimpleXMLElement('<xml/>');

$sql = "select * from mahasiswa ";
$result = mysqli_query($connection, $sql) or die("Error " . mysqli_error($connection));

//membuat array
while ($row = mysqli_fetch_assoc($result)) {

    $track = $xml->addChild('mahasiswa');
    $track->addChild('NIM', $row['NIM']);
    $track->addChild('Nama', $row['Nama']);
   
}

print($xml->asXML());
//tutup koneksi ke database
mysqli_close($connection);
?>

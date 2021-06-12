<?php

    require_once('helper.php');

    $Nama = $_POST['Nama'];
   

    $query = "INSERT INTO mahasiswa(Nama) VALUES ('$Nama')";
    $sql    = mysqli_query($db_connect, $query);

    if ($sql){
       
    echo json_encode ( array('message' => 'created!') );
    }else {
        echo json_encode ( array('message' => 'error') );
    }
?>
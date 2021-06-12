<?php

    require_once('helper.php');

    $query = "SELECT * FROM mahasiswa ORDER BY NIM DESC";
    $sql    = mysqli_query($db_connect, $query);

    if ($sql){
        $result = array();
        while ($row = mysqli_fetch_array($sql)){
            array_push ($result,array(
                'NIM' => $row ['NIM'],
                'Nama' => $row ['Nama'],
            ) );
        }
        
    
    echo json_encode ( array('mahasiswa' => $result) );
    }
?>
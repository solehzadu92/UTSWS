<?php
//index.php
?>
<!DOCTYPE html>
<html>
 <head>
  <title>IMPORT XML INTO DATABASE</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>
 <body>
  <br />
  <div class="container">
   <div class="row">
    <h2 align="center">IMPORT XML </h2>
    <br />
    <div class="col-md-9" style="margin:0 auto; float:none;">
     <span id="message"></span>
     <form method="post" id="import_form" enctype="multipart/form-data">
      <div class="form-group">
       <label>Select XML File</label>
       <input type="file" name="file" id="file" />
      </div>
      <br />
      <div class="form-group">
       <input type="submit" name="submit" id="submit" class="btn btn-info" value="Import" />
      </div>
     </form>
    </div>
   </div>
  </div>
 </body>
</html>
<script>
$(document).ready(function(){
 $('#import_form').on('submit', function(event){
  event.preventDefault();

  $.ajax({
   url:"import.php",
   method:"POST",
   data: new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   beforeSend:function(){
    $('#submit').attr('disabled','disabled'),
    $('#submit').val('Importing...');
   },
   success:function(data)
   {
    $('#message').html(data);
    $('#import_form')[0].reset();
    $('#submit').attr('disabled', false);
    $('#submit').val('Import');
   }
  })

  setInterval(function(){
   $('#message').html('');
  }, 5000);

 });
});
</script>


import.php


<?php
//import.php
sleep(3);
$output = '';

if(isset($_FILES['file']['name']) &&  $_FILES['file']['name'] != '')
{
 $valid_extension = array('xml');
 $file_data = explode('.', $_FILES['file']['name']);
 $file_extension = end($file_data);
 if(in_array($file_extension, $valid_extension))
 {
  $data = simplexml_load_file($_FILES['file']['tmp_name']);
  $connect = new PDO('mysql:host=localhost;dbname=soleh_zadu','root', '');
  $query = "
  INSERT INTO mahasiswa 
   (NIM,Nama) 
   VALUES(:NIM, :Nama);
  ";
  $statement = $connect->prepare($query);
  for($i = 0; $i < count($data); $i++)
  {
   $statement->execute(
    array(
     ':NIM'   => $data->mahasiswa[$i]->NIM,
     ':Nama'  => $data->mahasiswa[$i]->Nama,
     
    )
   );

  }
  $result = $statement->fetchAll();
  if(isset($result))
  {
   $output = '<div class="alert alert-success">Import Data Done</div>';
  }
 }
 else
 {
  $output = '<div class="alert alert-warning">Invalid File</div>';
 }
}
else
{
 $output = '<div class="alert alert-warning">Please Select XML File</div>';
}

echo $output;

?>
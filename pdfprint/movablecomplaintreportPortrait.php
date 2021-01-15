
<?php  include('../dbconfig.php'); ?> 

<!DOCTYPE html>
<html>
<head>
  <title>Complaint report</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="print.css" media="print" >

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="print.css" media="print" > 


</head>

<body onafterprint="myFunction()">

<?php $results = mysqli_query($conn, "SELECT c.proposedDate , c.c_assetID, c.detail ,u.name ,  c.setledDate
FROM complaints c 
JOIN users u
ON c.c_userIC = u.u_userIC
JOIN assets a
ON c.c_assetID = a.a_assetID
AND a.a_category = 2;
"); ?>

<div class="container">
  <br>
<h2>Manage Asset</h2>

<table class="table table-bordered table-sm">
  <thead>
    <tr>
          <th>Tarikh</th>
          <th>No inventori komputer</th>
          <th>butir-butir kerosakan</th>
          <th>Nama pegawai</th>
          <th>Tarikh selesai</th>

    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)){ ?>
    <tr>
            <td><?php echo $row["proposedDate"]; ?></td>  
            <td><?php echo $row["c_assetID"]; ?></td>  
            <td><?php echo $row["detail"]; ?></td>
            <td><?php echo $row["name"]; ?></td>  
            <td><?php echo $row["setledDate"]; ?></td>  
      
    </tr>
   <?php } ?>
</table>
</div>
</body>
</html>

<script type="text/javascript">  
  window.print();
  function myFunction(){
  
  var i = 1 ; 
  if(i==1){
    window.location.href = 'printmenu.php';
    }
  }
</script>

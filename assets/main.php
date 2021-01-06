<?php  
	require_once("../dbconfig.php");
	if(!session_id())//if session_id is not found
	{
		session_start();
	}
	
	if(isset($_SESSION['u_userIC']) != session_id() )
	{
		header('location: ../login/login.php');
	}
?> 

<!DOCTYPE html>
<html>
<head>
  <title>Asset main page</title>
  <link rel="stylesheet" type="text/css" href="style.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <!-- displays a confirmation message to tell the user that a new record has been created in the database -->
  <?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
      <?php 
        echo $_SESSION['message']; 
        unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>


  <?php $results = mysqli_query($conn, "SELECT * FROM assets"); ?>

  <div class="container">
    <br>
    <h2>Manage Asset <a href = 'create.php' class = 'btn btn-info'>Create Asset</a></h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>assetID</th>
                <th>nameBI</th>
                <th>nameBM</th>
                <th>Category</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Amount</th>
                <!-- <th>Condition</th> -->
                <th>Purchased Date</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      
      <?php 
        while ($row = mysqli_fetch_array($results)) { 
      ?>
              <tr>
                <td><?php echo $row["a_assetID"]; ?></td>  
                <td><?php echo $row["a_nameBI"]; ?></td>  
                <td><?php echo $row["a_nameBM"]; ?></td>  
                <td> 
                    <?php 
                    if($row["a_category"] == 1){
                      echo "ICT";
                    }else{
                      echo "NON ICT";
                    } 
                  ?>
                </td> 


                <td><?php echo $row["description"]; ?></td>  
                <td><?php echo $row["cost"]; ?></td>  
                <td><?php echo $row["amount"]; ?></td>  
                <!-- <td> 
                  <?php 
                    // if($row["asset_condition"] == 2){
                    //   echo "Good";
                    // }else{
                    //   echo "Bad";
                    // } 
                  ?>
                </td>  -->

                <?php
                  $datetime = strtotime($row['date_purchased']);
                  $new_date = date('Y-m-d', $datetime);
                ?>


                <td><?php echo $new_date; ?></td>  
                <td>
                  <a href = 'update.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-warning'>Edit</a>&nbsp;
                  <a href = 'delete.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-danger'>Delete</a>
                </td>      

              </tr>
      <?php } ?>
    </table>

  </div>

</body>
</html>
<!--
edit_btn
del_btn
-->

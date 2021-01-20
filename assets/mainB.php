<?php  
	require_once("../dbconfig.php");
	if(!session_id())//if session_id is not found
	{
		session_start();
	}
    
    
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
	if(isset($_SESSION['u_userIC']) != session_id() )
	{
		header('location: ../login/login.php');
  }
  
  if ($_SESSION["userType"] != '2'){
      exit();
  }

  if (isset($_POST['category'])){
  $sql = "SELECT * FROM assets JOIN rooms 
          ON assets.a_roomID = rooms.r_roomID 
          WHERE a_category LIKE '%".$_POST['category']."%'
          AND PIC = '".$_SESSION["ic"]."';";
  }else{
      $sql = "SELECT * FROM assets JOIN rooms 
              ON assets.a_roomID = rooms.r_roomID
              WHERE PIC = '".$_SESSION["ic"]."';";
  }
  
  //echo $sql;
  $results = mysqli_query($conn, $sql); 

  $sql2 = "SELECT * FROM rooms WHERE PIC = '".$_SESSION["ic"]."';";
  $results2 = mysqli_query($conn, $sql2); 
  $row2 = mysqli_fetch_array($results2);



  include("../navbar/navbarB1.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $language['Create Asset']; ?></title>
</head>
<body>
  <div class="container-fluid">

    <div class="row align-items-start">
      <div class="col-md-8 col-xl-8 mb-12"><h1 class="text-dark mb-4"><?php echo $language['Asset List']; ?></h1></div>

      <div class="col-md-3 col-xl-3 mb-4"><a href="createB.php" class="btn btn-primary btn-lg"><?php echo $language['New Asset']; ?></a></div>

      <div class="col-md-1 col-xl-1 mb-2"><button class="btn btn-success" onclick="hide()">Filter</button></div>
    </div>

    <script>
        function hide() {
            var x = document.getElementById("filter");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>


    <div class="row">

      <div class="col">
        <div class="card shadow">
          <div class="card-body">
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                  <table class="table my-0" id="dataTable">
                      <thead>
                          <tr>

                          <th><?php echo $language['Asset ID']; ?></th>
                                <th><?php echo $language['BI Name']; ?></th>
                                <th><?php echo $language['BM Name']; ?></th>
                                <th><?php echo $language['Category']; ?></th>
                                <!-- <th>Description</th> -->
                                <th><?php echo $language['Cost']; ?></th>
                                <th><?php echo $language['Rooms']; ?></th>
                                <!-- <th>Condition</th> -->
                                <!-- <th>Purchased Date</th> -->
                          <th colspan="2"><?php echo $language['Action']; ?></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        while ($row = mysqli_fetch_array($results)) { 
                      ?>
                      <tr>
                        <td><a href="assetDetail.php?id=<?php echo $row["a_assetID"]; ?>"><?php echo $row["a_assetID"]; ?></a></td>  
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

                        <td><?php echo $row["cost"]; ?></td>  

                        <td><?php echo $row["r_nameBI"]; ?></td>  

                        <?php
                          $datetime = strtotime($row['date_purchased']);
                          $new_date = date('Y-m-d', $datetime);
                        ?>


                        <!-- <td><?php echo $new_date; ?></td>   -->
                        <td>
                          <a href = 'updateB.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-warning'><?php echo $language['Edit']; ?></a>&nbsp;
                          <a href = 'delete.php?assetID=<?php echo $row["a_assetID"]; ?>' style="color: rgb(14,14,14);" class = 'btn btn-danger'   onclick="return confirm('<?php echo $language['Are you sure you want to delete this assets?']; ?>')"><strong>X</strong></a>
                        </td>
                                        
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table> 
              </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>          
          </div>
        </div>
      </div>

      <div class="col-md-2 col-xl-3 mb-2"  id="filter" style="display: none;">
          <h3><?php echo $language['Filter']; ?></h3>

          <div class="card shadow">
            <div class="card-body">
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <form action="mainB.php" method="POST"> 

                  <label for="category" class="form-label"><?php echo $language['Category']; ?></label>
                  <select class="form-select" aria-label="Default select example" name="category">
                  <option selected value=''><?php echo $language['Open this select menu']; ?></option>
                    <?php
                        $values = [1, 2];
                        $arr = ['ICT', 'Non ICT'];

                        foreach($values as $value){
                            if ($_POST['category'] == $value){
                                echo "<option selected value='".$value."'>".$arr[$value-1]."</option>";
                            }else{
                                echo "<option value='".$value."'>".$arr[$value-1]."</option>";
                            }
                        }
                    ?>
                    </select><br>

                    <input type="hidden" name="block" value="<?php echo $_POST["block"]; ?>">
                    
                    <input type="submit" value="Apply Filter" class="btn btn-primary">
                    <a href="" class="btn btn-warning"><?php echo $language['Cancel']; ?></a>
                </form><br>
              </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
          </div>
      </div>
    </div>
    
  </div>

</div>
</body>
</html>
<?php
  include("../navbar/navbar2.php");

?>

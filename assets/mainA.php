<?php  
  //require_once("../dualLanguage/language.php");
  
	require_once("../dbconfig.php"); 
	if(!session_id())//if session_id is not found
	{
		session_start();
  }
    
	if(isset($_SESSION['u_userIC']) != session_id() )
	{
		header('location: ../login/login.php');
  }
  include("../navbar/navbar1.php");
  require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

  $parameter = "";

  $sql = "SELECT * FROM assets LEFT JOIN rooms ON assets.a_roomID = rooms.r_roomID LEFT JOIN blocks ON blok=block_no LEFT JOIN categories ON a_category = catID";

  if (isset($_GET["blocks"])){
    $sql .= " AND blok LIKE '%".$_GET["blocks"]."%'";
    $parameter.= "blocks=".$_GET['blocks'];
  }

  if (isset($_GET["rooms"])){
      $sql .= " AND r_roomID LIKE '%".$_GET["rooms"]."%'";
      $parameter.= "&rooms=".$_GET['rooms'];
  }

  if (isset($_GET["category"])){
      $sql .= " AND a_category LIKE '%".$_GET["category"]."%'";
      $parameter.= "&category=".$_GET['category'];
  }

  $sql .= " ORDER BY a_assetID ASC;";


  $results = mysqli_query($conn, $sql); 

  if (!$results)
  {
      echo "ERROR:  $conn->error";
      header("refresh: 6; location: readUser.php");
  } 
  
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $language['Create Asset']; ?></title>
</head>
<body>
  <div class="container-fluid">

    <div class="row align-items-start">
      <div class="col-md-8 col-xl-8 mb-12"><h1 class="text m-0 font-weight-bold"><?php echo $language['Asset List']; ?></h1></div>

      <div class="col-md-3 col-xl-3 mb-4">
        <a href="create.php" class="btn btn-primary btn-lg"><?php echo $language['New Asset']; ?></a>&nbsp&nbsp
        <button class="btn btn-success" onclick="hide()"><?php echo $language['Filter']; ?></button>
      </div>
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

    <div class = "row">
        <div class="col">
          <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                    <table class="table" id="dataTable">
                        <thead>
                          <tr>

                            <th><?php echo $language['Asset ID']; ?></th>
                            <th><?php echo $language['BI Name']; ?></th>
                            <th><?php echo $language['BM Name']; ?></th>
                            <th><?php echo $language['Category']; ?></th>
                            <th><?php echo $language['Cost']; ?></th>
                            <th><?php echo $language['Rooms']; ?></th>
                            <th colspan="2"><?php echo $language['Action']; ?></th>
                          </tr>

                        <?php 
                          if(isset($_GET["page"])){
                              $pageNum = $_GET["page"] - 1;
                          }else{
                              $pageNum = 1 - 1;
                          }

                          
                          $initItemNum = 5 * $pageNum + 1;
                          $finalItemNum = 5* $pageNum + 5;

                          $numOfRows = mysqli_num_rows($results);
                          $numOfPages = ceil($numOfRows / 5);
                          $counter = 0;

                          if ($numOfRows > 0) {
                            while ($row = mysqli_fetch_array($results)) { 
                              $counter++;
                              if($counter >= $initItemNum && $counter <= $finalItemNum){
                        ?>
                                <tr>
                                  <td><a href="assetDetail.php?id=<?php echo $row["a_assetID"]; ?>"><?php echo $row["a_assetID"]; ?></a></td>  
                                  <td><?php echo $row["a_nameBI"]; ?></td>  
                                  <td><?php echo $row["a_nameBM"]; ?></td>  
                                  <td> 
                                    <?php 
                                      if($row["a_category"] == 1){
                                        echo $language['ICT'];
                            
                                      }else{
                                        echo $language['Non-ICT']; 

                                      } 
                                    ?>
                                  </td> 

                                  <td><?php echo $row["cost"]; ?></td>  

                                  <td><a href="../Rooms/roomdetail.php?id=<?php echo $row["a_roomID"]; ?>"><?php echo $row["r_nameBI"]; ?></a></td>  

                                  <?php
                                    $datetime = strtotime($row['date_purchased']);
                                    $new_date = date('Y-m-d', $datetime);
                                  ?>


                                  <!-- <td><?php echo $new_date; ?></td>   -->
                                  <td>
                                    <a href = 'update.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-warning'><?php echo $language['Edit']; ?></a>&nbsp;
                                    <a href = 'delete.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-danger' style="color: rgb(14,14,14);"  onclick="return confirm('<?php echo $language['Are you sure you want to delete this assets?']; ?>')"><strong>X</strong></a>
                                  </td>

                                </tr>

                        <?php 
                              }
                          }                        
                        } 
                        
                        ?>   
                                        
                        </thead>
                    </table> 
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>     
            </div>
          </div>
          <!-- Pager -->
        <nav aria-label="Page navigation news">
            <ul class="pagination justify-content-end flex-wrap">
                <li class="page-item <?php if ($_GET['page'] == 1 || !isset($_GET['page'])) 
                                                echo "disabled"; ?>">

                    <a class="page-link" href="<?php echo (!empty($parameter))? "?".$parameter."&" : '?'; ?>page=<?php if (isset($_GET['page'])){
                                                                if ($_GET["page"] == 1)
                                                                    echo  $_GET["page"];
                                                                else 
                                                                    echo  $_GET["page"] - 1;
                                                                }else{
                                                                    echo "1";
                                                                }
                                                    ?>"><?php echo $language['Previous'];?></a></li>
                                <?php
                                    for ($i = 1 ; $i <= $numOfPages ; $i++){ 
                                ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo (!empty($parameter))? "?".$parameter."&" : '?'; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                <?php
                                    }
                                ?>
                                <li class="page-item <?php if($_GET['page'] == $numOfPages)
                                                        echo "disabled"; ?>">
                                    <a class="page-link" href="<?php echo (!empty($parameter))? "?".$parameter."&" : '?'; ?>page=<?php if (isset($_GET['page'])){
                                                                                if($_GET["page"] + 1 > $numOfPages)
                                                                                    echo  $_GET["page"];
                                                                                else 
                                                                                    echo  $_GET["page"]+1;
                                                                            }else{
                                                                                echo "2";
                                                                            }
                                                                            
                                                                    ?>"><?php echo $language['Next'];?></a>
                                </li>
            </ul>
        </nav>
        </div>

        <div class="col-md-2 col-xl-3 mb-2" id="filter" style="display: none;">
          <div class="card shadow">
            <div class="card-body">
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                  <form action="mainA.php" method="GET"> 
                    <label for="blocks" class="form-label"><?php echo $language['Blocks']; ?></label>
                    <select class="form-select" aria-label="Default select example" name="blocks" id="blocks">
                        <option selected value=""><?php echo $language['Open this select menu']; ?></option>
                        <?php
                          $sql2 = "SELECT * FROM blocks";
                          $result2 = mysqli_query($conn, $sql2);

                          while($row2 = mysqli_fetch_array($result2)){
                            if ($_GET['blocks'] == $row2['block_no']){
                                  echo "<option selected value='".$row2['block_no']."'>".$row2["b_name".$_SESSION['language'].""]."</option>";
                            }else{
                                echo "<option value='".$row2['block_no']."'>".$row2["b_name".$_SESSION['language'].""]."</option>";
                            }
                          }
                        ?>
                    </select><br>

                    <label for="rooms" class="form-label"><?php echo $language['Rooms']; ?></label>
                    <select class="form-select" aria-label="Default select example" name="rooms" id="rooms">
                        <option selected value=""><?php echo $language['Open this select menu']; ?></option>
                        <?php
                          $sql2 = "SELECT * FROM rooms WHERE blok = '".$_GET["blocks"]."'";
                          $result2 = mysqli_query($conn, $sql2);

                          while($row2 = mysqli_fetch_array($result2)){
                            if ($_GET['rooms'] == $row2['r_roomID']){
                                  echo "<option selected value='".$row2['r_roomID']."'>".$row2["r_name".$_SESSION['language'].""]."</option>";
                            }else{
                                echo "<option value='".$row2['r_roomID']."'>".$row2["r_name".$_SESSION['language'].""]."</option>";
                            }
                          }
                        ?>
                    </select><br>

                    <script type="text/javascript">
                      document.getElementById('blocks').addEventListener('change', loadRooms);

                      function loadRooms(){
                          let block = document.getElementById('blocks').value;

                          let xhr = new XMLHttpRequest();
                          xhr.open('GET', `assetsBack/rooms.php?blocks=${block}`, true);
                          
                          xhr.onreadystatechange = function(){
                              if (this.status === 200 && this.readyState === 4){
                                  let rooms = JSON.parse(this.responseText);

                                  let lang = "<?php echo $_SESSION["language"]; ?>";

                                  output = '';

                                  if(lang ==='BI'){
                                      output+= `<option value="" selected>Open this select menu</option>`;
                                      for (var i in rooms){
                                          output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBI}</option>`;
                                      }
                                  }else{
                                      output+= `<option value="" selected>Tunjuk Menu</option>`;
                                      for (var i in rooms){
                                          output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBM}</option>`;
                                      }
                                  }
                                  
                                  document.getElementById('rooms').innerHTML = output;
                                
                              }else if(this.status == 404){
                                  console.log('Fail');
                              }
                          }
                          xhr.send();
                      }
                      </script>

                    <label for="category" class="form-label"><?php echo $language['Category']; ?></label>
                    <select class="form-select" aria-label="Default select example" name="category">
                    <option selected value=''><?php echo $language['Open this select menu']; ?></option>          
                      <?php
                            $values = [1, 2];
                    
                            $arr = [$language['ICT'], $language['Non-ICT']];

                            foreach($values as $value){
                                if ($_GET['category'] == $value){
                                    echo "<option selected value='".$value."'>".$arr[$value-1]."</option>";
                                }else{
                                    echo "<option value='".$value."'>".$arr[$value-1]."</option>";
                                }
                            }
                        ?>
                    </select><br>

                    <input type="hidden" name="block" value="<?php echo $_GET["block"]; ?>">
                    
                    <input type="submit" value="<?php echo $language['Apply']; ?>" class="btn btn-primary">
                    <a href="?" class="btn btn-warning"><?php echo $language['Cancel']; ?></a>
                  </form><br>
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
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

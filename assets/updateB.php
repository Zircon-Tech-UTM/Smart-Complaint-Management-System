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

    if ($_SESSION["userType"] != '2'){
        exit();
    }

    if(isset($_GET['assetID']))
    {
        $assetID = $_GET['assetID'];
    }


    $sql = "SELECT * FROM assets JOIN rooms ON assets.a_roomID = rooms.r_roomID WHERE a_assetID = '$assetID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (isset($row["a_img_path"]))
        $_SESSION["remove"] = $row["a_img_path"];

    $sql2 = "SELECT * FROM blocks JOIN rooms ON rooms.blok = blocks.block_no AND PIC = '".$_SESSION["ic"]."';";
    $result2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_array($result2);

    include("updateprocess.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Asset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 

</head>
<body>
    <div class="container">
        <h2>Update Asset</h2>
        <form action="updateprocess.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="assetID" value="<?php echo $row['a_assetID']; ?>">

            <div class="form-group">
                <label for="AsssetID">AssetID</label>
                <input type="text" class="form-control <?php echo (!empty($assetIDErr)) ? 'is-invalid' : ''; ?>" id="AsssetID" placeholder="Enter AssetID" name="assetID" value="<?php echo $row['a_assetID']; ?>" >
                <span class="help-block"><?php echo $assetIDErr;?></span>
            </div>

            <div class="form-group">
                <label for="BI_Name">BI Name</label>
                <input type="text" class="form-control <?php echo (!empty($nameBIErr)) ? 'is-invalid' : ''; ?>" id="BI_Name" placeholder="Enter name in BI" name="nameBI" value="<?php echo $row['a_nameBI']; ?>" >
                <span class="help-block"><?php echo $nameBIErr;?></span>
            </div>

            <div class="form-group">
                <label for="BM_Name">BM Name</label>
                <input type="text" class="form-control <?php echo (!empty($nameBMErr)) ? 'is-invalid' : ''; ?>" id="BM_Name" placeholder="Enter name in BM" name="nameBM" value="<?php echo $row['a_nameBM']; ?>" >
                <span class="help-block"><?php echo $nameBMErr;?></span>
            </div>

            <div>
                <label for="blocks" class="form-label">Blocks</label><br>
                    <input type="text" class="form-control" value="<?php echo $row2['b_nameBI']; ?>" disabled>
                    <input type="hidden" value="<?php echo $row2['block_no']; ?>" name="blocks">
            </div><br>

            <div>
                <label for="rooms" class="form-label">Rooms</label><br>
                    <input type="text" class="form-control" value="<?php echo $row2['r_nameBI']; ?>" disabled>
                    <input type="hidden" value="<?php echo $row2['r_roomID']; ?>" name="rooms">
                    <span class="help-block"><?php echo $roomErr;?></span>
            </div><br>



            
            <!-- <label>Category</label>
            <div class="radio">
            <label><input type="radio" name="category" value="1" 
                    <?php
                        if($row['a_category']== 1){
                            echo "checked";
                        }
                    ?> >ICT</label>    
            </div>
                <div class="radio">
                <label><input type="radio" name="category" value="2" 
                    <?php
                        if($row['a_category']== 2){
                            echo "checked";
                        }
                    ?> >Non-ICT</label> 
            </div> -->

            <label>Category</label>
            <div>
            <?php
                $array2 =['1','2'];

                foreach($array2 as $arr2){
                    if($arr2 == $row['a_category']){
                        echo "<label><input type='radio' name='category' value=".$arr2." checked >";
                        if($arr2=='1'){
                            echo "ICT";
                            echo "</input></label>";
                        }
                        else{
                            echo "Non-ICT";
                            echo "</input></label>";
                        }
                        echo "<br>";
                    }else {
                        echo "<label><input type='radio' name='category' value=".$arr2." >";
                        if($arr2=='1'){
                            echo "ICT";
                            echo "</input></label>";
                        }
                        else{
                            echo "Non-ICT";

                            echo "</input></label>";
                        }
                        echo "<br>";
                    }  

                    } // end of foreach()
                ?>
                <span class="help-block"><?php echo $categoryErr;?></span>
            </div>

            <div class="form-group">
                <label for="Description">Description</label>
                <textarea  class="form-control" rows="5" id="Description" placeholder="Enter description " name="description" > <?php echo $row['description']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="Cost">Cost</label>
                <input type="text" class="form-control <?php echo (!empty($costErr)) ? 'is-invalid' : ''; ?>" id="Cost" placeholder="Enter cost" name="cost" value="<?php echo $row['cost']; ?>" >
                <span class="help-block"><?php echo $costErr;?></span>
            </div>

            <div class="form-group">
                <label for="Amount">Amount </label>
                <input type="text" class="form-control <?php echo (!empty($amountErr)) ? 'is-invalid' : ''; ?>" id="Amount " placeholder="Enter amount " name="amount" value="<?php echo $row['amount']; ?>" >
                <span class="help-block"><?php echo $amountErr;?></span>
            </div>
            
            <!-- <div class="form-group">
                <label for="Condition">Condition</label>
                <select name = 'asset_condition' class="form-select" aria-label="Default select example">
                    <option selected disabled>Select Condition</option>
                        <?php
                            // $array = ['1','2'];
                            // foreach($array as $arr)
                            // {
                            //     if($arr == $row['asset_condition'])
                            //     {
                            //         echo"<option selected = 'selected' value=".$arr.">";
                            //         if($arr == '1')
                            //         {
                            //             echo "Good";
                            //         }
                            //         else
                            //         {
                            //             echo "Bad";
                            //         }
                            //         echo "</option>";
                            //     }
                            //     else
                            //     {
                            //         echo"<option value=".$arr.">";
                            //         if($arr == '1')
                            //         {
                            //             echo "Good";
                            //         }
                            //         else
                            //         {
                            //             echo "Bad";
                            //         }
                            //         echo "</option>";
                            //     }
                            // }
                        
                        ?>
                </select>             
            </div> -->

            <?php
                $datetime = strtotime($row['date_purchased']);
                $new_date = date('Y-m-d', $datetime);
            ?>

            <div class="form-group">
                <label for="Date_Purchased">Date purchased</label>
                <input type="date" class="form-control <?php echo (!empty($date_purchasedErr)) ? 'is-invalid' : ''; ?>" id="Date_Purchased" name="date_purchased" value="<?php echo $new_date; ?>" >
                <span class="help-block"><?php echo $date_purchasedErr;?></span>
            </div>
            <br>

            <div class="form-group">
                <label class="control-label">Asset Image</label>
                <input class="input-group" type="file" name="image" onchange="readURL(this);" />
                <img id="blah" src="<?php echo $row['a_img_path'] ?>" alt="asset image" />
                <span class="help-block"><?php echo $errMSG;?></span>
            </div>
            <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#blah')
                                .attr('src', e.target.result)
                                .width(150)
                                .height(200);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

            <div>            
                <button type="submit" class="btn btn-info"   onclick="return confirm('Do you want to save the changes?')">Modify</button>
                <button type="reset" class="btn btn-warning">Reset </button>
            </div>
        </form>
    </div>
</body>
</html>

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

    if(isset($_GET['assetID']))
    {
        $assetID = $_GET['assetID'];
    }


    $sql = "SELECT * FROM assets WHERE a_assetID = '$assetID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Asset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <h2>Update Asset</h2>
        <form action="updateprocess.php" method="POST">
            <input type="hidden" name="assetID" value="<?php echo $row['a_assetID']; ?>">

            <div class="form-group">
                <label for="AsssetID">AssetID</label>
                <input type="text" class="form-control" id="AsssetID" placeholder="Enter AssetID" name="assetID" value="<?php echo $row['a_assetID']; ?>" >
            </div>

            <div class="form-group">
                <label for="BI_Name">BI Name</label>
                <input type="text" class="form-control" id="BI_Name" placeholder="Enter name in BI" name="nameBI" value="<?php echo $row['a_nameBI']; ?>" >
            </div>

            <div class="form-group">
                <label for="BM_Name">BM Name</label>
                <input type="text" class="form-control" id="BM_Name" placeholder="Enter name in BM" name="nameBM" value="<?php echo $row['a_nameBM']; ?>" >
            </div>

            
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
            </div>

            <div class="form-group">
                <label for="Description">Description</label>
                <textarea  class="form-control" rows="5" id="Description" placeholder="Enter description " name="description" > <?php echo $row['description']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="Cost">Cost</label>
                <input type="text" class="form-control" id="Cost" placeholder="Enter cost" name="cost" value="<?php echo $row['cost']; ?>" >
            </div>

            <div class="form-group">
                <label for="Amount">Amount </label>
                <input type="text" class="form-control" id="Amount " placeholder="Enter amount " name="amount" value="<?php echo $row['amount']; ?>" >
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
                <input type="date" class="form-control" id="Date_Purchased" name="date_purchased" value="<?php echo $new_date; ?>" >
            </div>
            <br>

            <div>            
                <button type="submit" class="btn btn-info">Modify</button>
                <button type="reset" class="btn btn-warning">Reset </button>
            </div>
        </form>
    </div>
</body>
</html>

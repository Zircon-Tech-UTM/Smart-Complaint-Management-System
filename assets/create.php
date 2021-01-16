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
   //include("../navbar/navbar1.php");
  include("createprocess.php");
?>

<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
  <h1>Create Asset</h1>
    <div class="container">    
      <form action="" method="POST">

        <div class="form-group">
          <label for="AsssetID">AssetID</label>
          <input type="text" class="form-control <?php echo (!empty($assetIDErr)) ? 'is-invalid' : ''; ?>" id="AsssetID" placeholder="Enter AssetID" name="assetID" value="<?php echo $assetID; ?>">
          <span class="help-block"><?php echo $assetIDErr;?></span>
        </div>

        <div class="form-group">
          <label for="BI_Name">BI Name</label>
          <input type="text" class="form-control <?php echo (!empty($nameBIErr)) ? 'is-invalid' : ''; ?>" id="BI_Name" placeholder="Enter name in BI" name="nameBI"  value="<?php echo $nameBI; ?>">
           <span class="help-block"><?php echo $nameBIErr;?></span>
        </div>
            
        <div class="form-group">
          <label for="BM_Name">BM Name</label>
          <input type="text" class="form-control <?php echo (!empty($nameBMErr)) ? 'is-invalid' : ''; ?>" id="BM_Name" placeholder="Enter name in BM" name="nameBM"  value="<?php echo $nameBM; ?>" >
          <span class="help-block"><?php echo $nameBMErr;?></span>
        </div>

        <label>Category</label>
        <div class="radio ">
          <!-- <label><input type="radio" id="1" name="category" value="1" >ICT</label>
        </div>
        <div class="radio">
          <label><input type="radio" id="2" name="category" value="2" >Non-ICT</label>
        </div> -->
        
        <?php
                $array2 =['1','2'];

                foreach($array2 as $arr2){
                    if($arr2 == $category){
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
          <!-- <script type="text/javascript">
            function radioValidation(){

                var category = document.getElementsByName('category');
                var categoryValue = false;

                for(var i=0; i<category.length;i++){
                    if(category[i].checked == true){
                        categoryValue = true;    
                    }
                }
                if(!categoryValue){
                    alert("Choose a category");
                    return false;
                }

            }
        </script> -->

        <div class="form-group">
          <label for="Description">Description</label>
          <textarea  class="form-control" rows="5" id="Description" placeholder="Enter description " name="description" ></textarea>
        </div>
        
        <div class="form-group">
          <label for="Cost">Cost</label>
          <input type="text" class="form-control <?php echo (!empty($costErr)) ? 'is-invalid' : ''; ?>" id="Cost" placeholder="Enter cost" name="cost" value="<?php echo $cost; ?>" >
          <span class="help-block"><?php echo $costErr;?></span>
        </div>

        <div class="form-group">
          <label for="Amount">Amount </label>
          <input type="text" class="form-control <?php echo (!empty($amountErr)) ? 'is-invalid' : ''; ?>" id="Amount " placeholder="Enter amount " name="amount" value="<?php echo $amount; ?>" >
           <span class="help-block"><?php echo $amountErr;?></span>
        </div>

        <!-- <div class="form-group">
          <label for="Condition">Condition</label>

          <select class="form-control" id="condition" name="asset_condition" >
          <option selected disabled>Select condition</option>
          <option value="1" >Good</option>
          <option value="2" >Bad</option>

          </select>
        </div> -->

        <div class="form-group">
          <label for="Date_Purchased">Date purchased</label>
          <input type="date" class="form-control <?php echo (!empty($date_purchasedErr)) ? 'is-invalid' : ''; ?>" id="Date_Purchased" name="date_purchased" value="<?php echo $date_purchased; ?>" >
          <span class="help-block"><?php echo $date_purchasedErr;?></span>
        </div>

        <button type="submit"  class="btn btn-success" value="Submit" name="" >Submit</button>
        
      </form>
    </div>

</body>
</html>
<!-- <?php include("../navbar/navbar2.php");?> -->

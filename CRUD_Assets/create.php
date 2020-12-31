  
<?php include ('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
    <h1>Create Asset</h1>
    <div class="container-fluid">
        <div class="container">
 
  <form action="createprocess.php" method="POST">

    <div class="form-group">
      <label for="AsssetID">AssetID</label>
      <input type="text" class="form-control" id="AsssetID" placeholder="Enter AssetID" name="assetID" >
    </div>
        <div class="form-group">
      <label for="BI_Name">BI Name</label>
      <input type="text" class="form-control" id="BI_Name" placeholder="Enter name in BI" name="nameBI" >
    </div>
        <div class="form-group">
      <label for="BM_Name">BM Name</label>
      <input type="text" class="form-control" id="BM_Name" placeholder="Enter name in BM" name="nameBM" >
      </div>

      <label>Category</label>
      <div class="radio">
      <label><input type="radio" name="category" value="1" >ICT</label>
    </div>

    <div class="radio">
      <label><input type="radio" name="category" value="2" >Non-ICT</label>
    </div>
      <div class="form-group">
      <label for="Description">Description</label>
      <textarea  class="form-control" rows="5" id="Description" placeholder="Enter description " name="description" ></textarea>
      </div>
    
      <div class="form-group">
      <label for="Cost">Cost</label>
      <input type="text" class="form-control" id="Cost" placeholder="Enter cost" name="cost" >
    </div>

    <div class="form-group">
      <label for="Amount">Amount </label>
      <input type="text" class="form-control" id="Amount " placeholder="Enter amount " name="amount" >
    </div>

    <div class="form-group">
    <label for="Condition">Condition</label>

    <select class="form-control" id="condition" name="asset_condition" >
    <option selected disabled>Select condition</option>
    <option value="1" >Good</option>
    <option value="2" >Bad</option>

    </select>
    </div>
    <div class="form-group">
      <label for="Date_Purchased">Date purchased</label>
      <input type="date" class="form-control" id="Date_Purchased" name="date_purchased" >
    </div>


    <button type="submit"  class="btn btn-success" value="Submit" name="">Submit</button>
    
  </form>
</div>

</body>
</html>

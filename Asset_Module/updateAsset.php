
<?php  include('server.php'); ?>

<?php 
// https://stackoverflow.com/questions/59221411/why-am-i-getting-a-warning-when-i-try-to-count-a-mysqli-result
	if (isset($_GET['edit'])) {
		$assetID = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM assets WHERE assetID=$assetID");

		if ($record && $n = mysqli_fetch_array($record) ) {
			//$n = mysqli_fetch_array($record);
			$assetID = $n['assetID'];
			$nameBI = $n['nameBI'];
			$nameBM = $n['nameBM'];
			$category = $n['category'];
			$description = $n['description'];
			$cost = $n['cost'];
			$amount = $n['amount'];
			$asset_condition = $n['asset_condition'];
			$date_purchased = $n['date_purchased'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Asset</title>
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

<div class="container">

<?php $results = mysqli_query($conn, "SELECT * FROM assets"); ?>

<table>
	<thead>
		<tr>
			<th>assetID</th>
            <th>nameBI</th>
            <th>nameBM</th>
            <th>Category</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Amount</th>
            <th>Condition</th>
            <th>Purchased Date</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row["assetID"]; ?></td>  
            <td><?php echo $row["nameBI"]; ?></td>  
            <td><?php echo $row["nameBM"]; ?></td>  
            <td><?php echo $row["category"]; ?></td>  
            <td><?php echo $row["description"]; ?></td>  
            <td><?php echo $row["cost"]; ?></td>  
            <td><?php echo $row["amount"]; ?></td>  
            <td><?php echo $row["asset_condition"]; ?></td>  
            <td><?php echo $row["date_purchased"]; ?></td>  
			<td>
				<a href="updateAsset.php?edit=<?php echo $row['assetID']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['assetID']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

<form>

  <h2>Create Asset</h2>
  <form action="server.php" method="POST">
  	<input type="hidden" name="assetID" value="<?php echo $assetID; ?>">
    <div class="form-group">
      <label for="AsssetID">AssetID</label>
      <input type="text" class="form-control" id="AsssetID" placeholder="Enter AssetID" name="assetID" value="<?php echo $assetID; ?>" >
    </div>
        <div class="form-group">
      <label for="BI_Name">BI Name</label>
      <input type="text" class="form-control" id="BI_Name" placeholder="Enter name in BI" name="nameBI" value="<?php echo $nameBI; ?>" >
    </div>
        <div class="form-group">
      <label for="BM_Name">BM Name</label>
      <input type="text" class="form-control" id="BM_Name" placeholder="Enter name in BM" name="nameBM" value="<?php echo $nameBM; ?>" >
      </div>
      
      <div class="form-group">
      <label for="Description">Description</label>
      <textarea  class="form-control" rows="5" id="Description" placeholder="Enter description " name="description"  ><?php echo $description; ?></textarea>
      </div>
    
      <div class="form-group">
      <label for="Cost">Cost</label>
      <input type="text" class="form-control" id="Cost" placeholder="Enter cost" name="cost" value="<?php echo $cost; ?>" >
    </div>

        <div class="form-group">
      <label for="Amount">Amount </label>
      <input type="text" class="form-control" id="Amount " placeholder="Enter amount " name="amount" value="<?php echo $amount; ?>" >
    </div>

   <label>Category</label>
      <div class="radio">
      <label><input type="radio" name="category" value="1" >ICT</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="category" value="2" >Non-ICT</label>
    </div>

    <div class="form-group">
    <label for="Condition">Condition</label>
    <select class="form-control" id="condition" name="asset_condition" value="<?php echo $asset_condition; ?>">
    <option value="1" >New</option>
    <option value="2" >Second hand</option>

    </select>
    </div>
    <div class="form-group">
      <label for="Date_Purchased">Date purchased</label>
      <input type="date" class="form-control" id="Date_Purchased" name="date_purchased" value="<?php echo $date_purchased; ?>" >
    </div>

	<div>
    <?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
	<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
	<?php endif ?>

	</div>
  </form>


</body>
</html>




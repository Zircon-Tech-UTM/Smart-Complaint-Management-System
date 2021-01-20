
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

    $sql1 = "SELECT * FROM users WHERE u_userIC=".$_SESSION['ic'].";";

    $result1 = mysqli_query($conn, $sql1);

    if (!$result1)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: readUser.php");
    } 

    $row1 = mysqli_fetch_array($result1);

	if ($_SESSION["userType"] == '1'){
		include ('..\navbar\navbar1.php');
    }else if($_SESSION["userType"] == '2'){
		include ('..\navbar\navbarB1.php');
	}else if($_SESSION["userType"] == '3'){
		include ('..\navbar\navbarC.php');
	}else if($_SESSION["userType"] == '4'){
		include ('..\navbar\navbarD.php');
	}

    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<h1 class="text m-0 font-weight" style = "text-align:center;">PRINT PDF REPORT</h1><br>
		<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> -->
		<div class = 'row';>
			<div class="col-auto col-lg-6 col-xl-6" style="width: 590px;">
				<div class="card shadow mb-4">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="text-primary font-weight-bold m-0">ICT COMPLAINTS</h4>
					</div>
					<div class="card-body">
						<div class="border rounded">
							<div class = 'row';>
								<div class="col-md-2 col-lg-2 col-xl-2 mb-12">
									<a href="ictcomplaintreportPortrait.php" class="btn btn-warning btn-md">PORTRAIT</a>
								</div>
								<div class="col-md-1 col-lg-1 col-xl-1 mb-6"><br></div>
								<div class="col-md-2 col-lg-2 col-xl-2 mb-12">
									<a href="ictcomplaintreportLandscape.php" class="btn btn-warning btn-md">LANDSCAPE</a>
								</div>
							</div><br>
						</div>
					</div>
				</div>
			</div>
			<div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
				<div class="card shadow mb-4">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="text-primary font-weight-bold m-0">NON-ASSET COMPLAINT</h4>
					</div>
					<div class="card-body">
						<div class="border rounded">
							<div class = 'row';>
								<div class="col-md-2 col-xl-2 mb-12">
									<a href="movablecomplaintreportPortrait.php" class="btn btn-warning btn-md">PORTRAIT</a>
								</div>
								<div class="col-md-1 col-xl-1 mb-6"><br></div>
								<div class="col-md-2 col-xl-2 mb-12">
									<a href="movablecomplaintreportLandscape.php" class="btn btn-warning btn-md">LANDSCAPE</a>
								</div>
							</div>
						</div><br>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include ('..\navbar\navbar2.php'); ?>
<?php
    require_once("../CRUDusers/UsersBack/dbconfigUser.php");

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
        } 

        $row = mysqli_fetch_array($result);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

        <form action="forgotpwdFinalprocess.php" method="POST">
        <h2>Reset Password: </h2>
        
            <script>
                var check = function() {
                  if (document.getElementById('password').value ==
                    document.getElementById('confirm_password').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = '  (matching)';
                  } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = '  (not matching)';
                  }
                }
            </script>

            <?php
                  echo"<tr>";
                  echo "<th>".$row["name"]."</th>";
                  echo "<th>".$row["u_userIC"]."</th>";
                  echo "</tr>";
              ?>

            <div class ="row">
                <div class="col-6">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control form-control" placeholder="Enter password" value="<?php echo $row["pwd"]; ?>" required>
                </div>
                <div class="col-6">
                    <label for="psw-repeat" class="form-label">Re-type Password:<span id='message'></span></label>  
                   <input type="password" id="confirm_password" placeholder="Retype Password" name="confirm_password" class="form-control form-control" onkeyup='check();' value="<?php echo $row["pwd"]; ?>" required/>  
                </div>
            </div><br>
                <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Edit"/>
              <input type="reset" name="clear" value="Clear"class="btn btn-warning">
            
        </form>
    </div>
</body>
</html>
<?php
}
?>

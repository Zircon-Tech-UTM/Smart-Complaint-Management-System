<?php 
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    require_once("../dbconfig.php");

    if (isset($_POST['position'])){
        $sql = "SELECT * FROM users WHERE userType = '".$_POST['position']."' ORDER BY postBI ASC ;";
    }else{
        $sql = "SELECT * FROM users ORDER BY postBI ASC;";
    }

    $result  = mysqli_query($conn, $sql);

    if(!$result){
        echo "ERROR: $conn->error";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row align-items-start">
            <div class="col-9"><h1 class="display-4">Users List</h1></div>
            <div class="col-3"><a href="createUser.php" class="btn btn-primary btn-lg">Create New User</a></div>
        </div>
        <div class="row">
            <div class="col-2">
                <h2>Filter</h2>
                <form action="" method="POST"> 
                    <label for="position" class="form-label">Positions</label>
                    <select class="form-select" aria-label="Default select example" name="position">
                        <option>Open this select menu</option>
                        <?php
                            $values = [1,2,3,4];
                            $positions = ['Admin','PIC', 'Assistant Computer Technician', 'Assistant Engineer'];

                            foreach($values as $value){
                                if ($_POST['position'] == $value){
                                    echo "<option selected value='".$value."'>".$positions[$value-1]."</option>";
                                }else{
                                    echo "<option value='".$value."'>".$positions[$value-1]."</option>";
                                }
                            }
                        ?>
                    </select><br>
                    
                    <input type="submit" value="Apply Filter" class="btn btn-primary">
                    <a href="" class="btn btn-warning">Cancel</a>
                </form>
            </div>

            <div class="col-10">
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">User IC</th>
                        <th scope="col">Position</th>
                        <!-- <th scope="col">Number of Complaints</th> -->
                        <th scope="col">Contact</th>
                    </tr>
                    <?php
                        $num=1;
                        while($row = mysqli_fetch_array($result))
                        {
                            echo"<tr>";
                            echo "<th scope='row'>".$num."</th>";
                            echo "<th>".$row["name"]."</th>";
                            echo "<th>".$row["u_userIC"]."</th>";
                            echo "<th>".$row["postBI"]."</th>";
                            // echo "<th>".$row["no_aduan"]."</th>";
                            echo "<th>".$row["contact"]."</th>";
                            $num++;
                        ?>
                        <th>
                            <a href="detailUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm">VIEW</a>
                            <a href="updateUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm">EDIT</a>

                            <?php
                                if ($row["u_userIC"] == $_SESSION['ic']){
                            ?>
                                    <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm disabled" onclick="return confirm('Are you sure you want to delete this account')"><strong>X</strong></a>
                            <?php
                                }else{
                            ?>
                                    <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete this account?')"><strong>X</strong></a>
                            <?php
                                }
                            ?>
                            
                        </th>
                    <?php
                            echo"</tr>";
                        }

                        mysqli_close($conn);
                    ?>

                </thead>
                </table>
            </div>
        
        </div>
        
        <br>
        <a href="../login/logout.php" class="btn btn-info">Logout</a>   
    </div>
</body>
</html>
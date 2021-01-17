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

    include("../navbar/navbar1.php");

    if (isset($_POST['position'])){
        $sql = "SELECT * FROM users WHERE userType LIKE '%".$_POST['position']."%' ORDER BY postBI ASC ;";
    }else{
        $sql = "SELECT * FROM users ORDER BY postBI ASC;";
    }


    $result = mysqli_query($conn, $sql);

    if (!$result)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: readUser.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Read List</title>
</head>
<body>
     <div class="container-fluid">

        <div class="row align-items-start">
            <div class="col-9"><h1 class="text-dark mb-4">Users List</h1></div>
            <div class="col-3"><a href="createUser.php" class="btn btn-primary btn-lg">Create New User</a></div>
        </div>

            <h3>Filter</h3>
                <form action="" method="POST"> 
                    <label for="position" class="form-label">Positions</label>
                    <select class="form-select" aria-label="Default select example" name="position">
                        <option value="">Open this select menu</option>
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
                </form><br>

        <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">User IC</th>
                    <th scope="col">Position</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>
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
                        echo "<th>".$row["contact"]."</th>";
                        $num++;
                    ?>
                    <th>
                        <a href="detailUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm" style="font-size: 17px">Detail</a>
                        <a href="updateUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-warning btn-sm" type="button" style="color: rgb(6,6,6);font-size: 17px;">Edit</a>

                        <?php
                            if ($row["u_userIC"] == $_SESSION['ic']){
                        ?>
                                <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-danger btn-sm disabled" type="button" style="color: rgb(14,14,14);font-size: 17px;background: #f15f51;" onclick="return confirm('Are you sure you want to delete this account')"><strong>X</strong></a>
                        <?php
                            }
                            else{
                        ?>
                                <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>"  class="btn btn-danger btn-sm" type="button" style="color: rgb(14,14,14);font-size: 17px;background: #f15f51;" onclick="return confirm('Are you sure you want to delete this account')"><strong>X</strong></a>
                        <?php
                            }
                        ?>
                        
                    </th>
                <?php
                        echo"</tr>";
                    }
                    mysqli_close($conn);
                    include("../navbar/navbar2.php");
                ?>
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </thead>
        </table>
    </div>
</div>
</div>
</div>
</body>
</html>


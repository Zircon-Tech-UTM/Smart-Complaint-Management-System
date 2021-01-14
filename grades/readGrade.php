<?php 
    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['ic']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    include("../navbar/navbar1.php");

    $sql = "SELECT * FROM grades ORDER BY g_gradeID;";

    $result = mysqli_query($conn, $sql);

    if (!$result)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: readGrade.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Read Grade List</title>
</head>
<body>
     <div class="container-fluid">
        <h1 class="text-dark mb-4" style="font-size: 37px;"><a href="createGrade.php" class="btn btn-primary float-right" type="button" style="width: 120px;height: 65px;margin: 0px;padding: 13px;">Create Grade</a>Grade Information</h1>
        <div class="card shadow">
                        <div class="card-header py-3"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Grade ID</th>
                    <th scope="col">Position in English</th>
                    <th scope="col">Position in Malay</th>
                    <th scope="col">Action</th>
                </tr>
                <?php
                    $num=1;
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<tr>";
                        echo "<th scope='row'>".$num."</th>";
                        echo "<th>".$row["g_gradeID"]."</th>";
                        echo "<th>".$row["g_postBI"]."</th>";
                        echo "<th>".$row["g_postBM"]."</th>";
                        $num++;
                    ?>
                    <th>
                       <a href="updateGrade.php?id=<?php echo $row["g_gradeID"]; ?>" class="btn btn-warning btn-sm" type="button" style="color: rgb(6,6,6);font-size: 17px;">Edit</a>
                       <a href="deleteGrade.php?id=<?php echo $row["g_gradeID"]; ?>"  class="btn btn-danger btn-sm" type="button" style="color: rgb(14,14,14);font-size: 17px;background: #f15f51;" onclick="return confirm('Are you sure to delete this grade')"><strong>X</strong></a>
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


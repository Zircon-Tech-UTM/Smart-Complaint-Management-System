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
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

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
    <title><?php echo $language['User List']; ?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
     <div class="container-fluid">

        <div class="row align-items-start">
            <div class="col-9"><h1 class="text-dark mb-4 font-weight-bold"><?php echo $language['Users List']; ?></h1></div>
            <div class="col-3"><a href="createUser.php" class="btn btn-primary btn-lg"><?php echo $language['New User']; ?></a></div>
        </div>

            <!-- <div class="row">
                <div class="col-3"> -->
                    <h3><?php echo $language['Filter']; ?></h3>
                    <form action="" method="POST"> 
                    <label for="position" class="form-label"><?php echo $language['Positions']; ?></label>
                <div class="row">
                <div class="col-md-5 col-lg-5 col-xl-3 mb-12">
                    <select class="form-select" aria-label="Default select example" name="position">
                        <option value=""><?php echo $language['Open this select menu']; ?></option>
                        <?php
                            $values = [1,2,3,4];
                            if ($_SESSION["language"] == 'BI')
                                $positions = ['Admin','PIC', 'Assistant Computer Technician', 'Assistant Engineer'];
                            else
                                $positions = ['Admin','PIC', 'Penolong Juruteknik Komputer', 'Penolong Jurutera'];

                            foreach($values as $value){
                                if ($_POST['position'] == $value){
                                    echo "<option selected value='".$value."'>".$positions[$value-1]."</option>";
                                }else{
                                    echo "<option value='".$value."'>".$positions[$value-1]."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-5 col-lg-5 col-xl-3 mb-12 d-flex justify-content-center">
                    <input type="submit" value="<?php echo $language['Apply']; ?>" class="btn btn-primary">&nbsp
                    <a href="" class="btn btn-warning"><?php echo $language['Cancel']; ?></a>
                </div>
                </form><br>
            </div><br>

        <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"><?php echo $language['Name']; ?></th>
                    <th scope="col"><?php echo $language['User IC']; ?></th>
                    <th scope="col"><?php echo $language['Position']; ?></th>
                    <th scope="col"><?php echo $language['Contact']; ?></th>
                    <th scope="col"><?php echo $language['Action']; ?></th>
                </tr>
                <?php
                    $num=1;
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<tr>";
                        echo "<td scope='row'>".$num."</td>";
                        echo "<td>".$row["name"]."</td>";
                        echo "<td>".$row["u_userIC"]."</td>";

                        if ($_SESSION['language'] == 'BI'){
                           echo "<td>".$row['postBI']."</td>";
                        }else if ($_SESSION['language'] == 'BM'){
                            echo "<td>".$row['postBM']."</td>";
                        }else{
                            echo "<td>".$row['postBM']."</td>";
                        }

                        echo "<td>".$row["contact"]."</td>";
                        $num++;
                    ?>
                    <th>
                        <a href="detailUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-info btn-sm" style="font-size: 17px"><?php echo $language['Detail']; ?></a>
                        <a href="updateUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-warning btn-sm" type="button" style="color: rgb(6,6,6);font-size: 17px;"><?php echo $language['Edit']; ?></a>

                        <?php
                            if ($row["u_userIC"] == $_SESSION['ic']){
                        ?>
                                <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-danger btn-sm disabled" type="button" style="font-size: 17px;background: #f15f51;" onclick="return confirm('<?php echo $language['Are you sure you want to delete this account?']; ?>')"><strong>X</strong></a>
                        <?php
                            }
                            else{
                        ?>
                                <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>"  class="btn btn-danger btn-sm" type="button" style="color: rgb(14,14,14);font-size: 17px;" onclick="return confirm('<?php echo $language['Are you sure you want to delete this account?']; ?>')"><strong>X</strong></a>
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


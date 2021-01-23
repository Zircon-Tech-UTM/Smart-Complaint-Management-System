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
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

    $sql = "SELECT * FROM grades ORDER BY g_gradeID;";

    $result = mysqli_query($conn, $sql);

    if (!$result)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 5; location: readGrade.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $language['Grade List']; ?></title>
</head>
<body>
     <div class="container-fluid">
        <div class="row align-items-start">
            <div class="col-md-5 col-xl-10 mb-12"><h1 class="text-dark mb-4 font-weight-bold" style="font-size: 37px;text-align: center;"><?php echo $language['GRADE LIST']; ?></h1></div>
            <div class="col-md-5 col-xl-2 mb-12 d-flex justify-content-center"><a href="createGrade.php" class="btn btn-primary" style="font-size=17px" ><?php echo $language['New Grade']; ?></a></div>
            <!-- type="button" style="width: 120px;height: 65px;margin: 0px;padding: 13px;" -->
        
        </div>
        
        <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col"><?php echo $language['Grade ID']; ?></th>
                    <th scope="col"><?php echo $language['Position']; ?></th>
                    <th scope="col"><?php echo $language['Action']; ?></th>
                </tr>
                <?php
                    $num=1;
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<tr>";
                        echo "<td scope='row'>".$num."</td>";
                        echo "<td>".$row["g_gradeID"]."</td>";

                        if ($_SESSION['language'] == 'BI'){
                           echo "<td>".$row["g_postBI"]."</td>";
                        }else if ($_SESSION['language'] == 'BM'){
                           echo "<td>".$row["g_postBM"]."</td>";
                        }else{
                           echo "<td>".$row["g_postBM"]."</td>";
                        }
                        $num++;
                    ?>
                    <th>
                       <a href="updateGrade.php?id=<?php echo $row["g_gradeID"]; ?>" class="btn btn-warning btn-sm" type="button" style="color: rgb(6,6,6);font-size: 17px;"><?php echo $language['Edit']; ?></a>
                       <a href="deleteGrade.php?id=<?php echo $row["g_gradeID"]; ?>"  class="btn btn-danger btn-sm" type="button" style="color: rgb(14,14,14);font-size: 17px;" onclick="return confirm('<?php echo $language['Are you sure you want to delete this grade?']; ?>')"><strong>X</strong></a>
                    </th>
                <?php
                        echo"</tr>";
                    }
                    mysqli_close($conn);
                    include("../navbar/navbar2.php");
                ?>
                </div>
            </thead>
        </table>
    </div>
</div>
</div>
</div>
</body>
</html>


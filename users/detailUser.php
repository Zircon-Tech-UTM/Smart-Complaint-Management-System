<?php
    require_once("..\dbconfig.php");
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
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql1 = "SELECT * FROM users, rooms WHERE u_userIC=".$id." AND (PIC = ".$id." OR PIC2 = ".$id." OR PIC3 = ".$id.");";
        $result1 = mysqli_query($conn, $sql1);

        if ($result1){
            $row1= mysqli_fetch_array($result1);}

        $sql = "SELECT * FROM users, grades WHERE u_userIC=".$id." AND u_grade = g_gradeID;";
        $result = mysqli_query($conn, $sql);

        if ($result){
            $row = mysqli_fetch_array($result);
?>          

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $language['User Detail']; ?></title>
</head>
<style>
    img{
        width: 500px;
        height: 500px;
    }
</style>
<body>
    <div class="container">
        <div class="container-fluid float-left">
                    <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['User Information']; ?></h3>
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
        
                                    <?php $EndingDate=date('Y-m-d h:i:s', strtotime('+1 year', strtotime($row["dateRegistered"])) ); ?> 
                                    <img src="<?php echo $row['u_img_path']; ?>" alt="<?php echo $language['user image']; ?>">
                                    <thead style="color: rgb(0,0,0);">
                                        <tr>
                                            <th><?php echo $language['Username/IC']; ?></th>
                                            <th><?php echo $row["u_userIC"];?></th>
                                        </tr>
                                    </thead>
                                    <tbody style="color: rgb(0,0,0);">
                                        <tr></tr>
                                        <tr>
                                            <td><strong><?php echo $language['Full Name']; ?>:</strong></td>
                                            <td><?php echo $row["name"];?></td>
                                        </tr>
                                        <tr></tr>
                                        <tr></tr>
                                        <tr>
                                            <td><strong><?php echo $language['Position:']; ?></strong></td>
                                            <td><?php if ($_SESSION['language'] == 'BI'){
                                                       echo $row['postBI'];
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo $row['postBM'];
                                                    }else{
                                                        echo $row['postBM'];
                                                    }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $language['Registered Date:']; ?></strong></td>
                                            <td><?php echo $row["dateRegistered"];?></td>
                                        </tr>
                                        <?php if ($row['postBI']=="PIC Of Room"||$row['postBI']=="PIC"||$row['postBM']=="PIC Makmal") { ?>
                                            <tr>
                                            <td><strong><?php echo $language['Ending Date:']; ?></strong></td>
                                            <td><?php echo $EndingDate;?></td>
                                        </tr>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><strong><?php echo $language['Grade:']; ?></strong></td>
                                            <td><?php echo $row["u_grade"];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $language['Grade Position:']; ?></strong></td>
                                            <td><?php if ($_SESSION['language'] == 'BI'){
                                                       echo $row['g_postBI'];
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo $row['g_postBM'];
                                                    }else{
                                                        echo $row['g_postBM'];
                                                    }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $language['Contact Number:']; ?></strong></td>
                                            <td><?php echo $row["contact"];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $language['Home Address:']; ?></strong></td>
                                            <td><?php echo $row["address"];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $language['Email Address:']; ?></strong></td>
                                            <td><?php echo $row["email"];?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <a href="updateUser.php?id=<?php echo $row["u_userIC"];?>" class="btn btn-warning"><?php echo $language['Edit']; ?></a>
                    <a href="deleteUser.php?id=<?php echo $row["u_userIC"];?>" class="btn btn-danger" onclick="return confirm('<?php echo  $language['Are you sure you want to delete this account?']; ?>')" ><?php echo $language['Delete']; ?></a>
                    <a href="#" class="btn btn-dark float-right" onclick="history.go(-1)"><?php echo $language['Back']; ?></a>
                </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
</body>
</html>



<?php
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 5; location: readUser.php?");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 5; location: readUser.php");
    }
    mysqli_close($conn);
    include("../navbar/navbar2.php");
    
?>


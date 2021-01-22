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

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    $sql1 = "SELECT * FROM users WHERE u_userIC=".$_SESSION['ic'].";";

    $result1 = mysqli_query($conn, $sql1);

    if (!$result1)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: ../dashboard.php");
    } 

    $row1 = mysqli_fetch_array($result1);

    $sql = "SELECT * FROM blocks";

    $result = mysqli_query($conn, $sql);
    include ('..\navbar\navbar1.php');
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $language['Blocks in KVPJB'];?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
</head>
<body>
    <script>
        $('.lang').click(function(){

                    $.ajax({
                        type: 'POST',
                        url: 'testing.php',
                        success: function(data) {
                            alert(data);
                        }
                    });
        });
    </script>

    <div class="container-fluid">
        <div class="row align-items-start">
            <div class="col-md-5 col-xl-10 mb-12"><h1 class="text m-0 font-weight-bold" style = "text-align: center;"><?php echo $language["BLOCKS' LIST"];?></h1></div>
            <div class="col-md-5 col-xl-2 mb-12 d-flex justify-content-center"><a href="createblock.php" class="btn btn-primary btn-lg"><?php echo $language['New Block'];?></a></div>
        </div>
        <br>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th><?php echo $language['Blocks'];?></th>
                                <th><?php echo $language['Block Name(English)'];?></th>
                                <th><?php echo $language['Block Name(Malay)'];?></th>
                                <th><?php echo $language['Location'];?></th>
                                <th><?php echo $language['Rooms'];?></th>
                                <th><?php echo $language['Action'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "<tr>";
                                    echo "<td>".$row['block_no']."</td>";
                                    echo "<td>".$row['b_nameBI']."</td>";
                                    echo "<td>".$row['b_nameBM']."</td>";
                                    if($row['location'] =='1')
                                    {
                                        echo "<td>".$language['Hostel']."</td>";
                                    }
                                    else if($row['location'] =='2')
                                    {
                                        echo "<td>".$language['College']."</td>";
                                    }
                                    else if($row['location'] =='3')
                                    {
                                        echo "<td>".$language['Others']."</td>";
                                    }
                                    echo "<td>
                                    <a href='blockrooms.php?id=".$row["block_no"]."'>".$language['Rooms in this block']."</a></td>";
                                    echo "<td>";
                        ?>
                                    <a href = 'blockmodify.php?id=<?php echo $row['block_no'];?>' class="btn btn-warning btn-sm" type="button" style="color: rgb(6,6,6);font-size: 17px;"><?php echo $language['Edit'];?></a>&nbsp
                                    <a href = 'blockcancel.php?id=<?php echo $row['block_no']; ?>' class="btn btn-danger btn-sm" type="button" style="color: rgb(14,14,14); " onclick="return confirm('<?php echo $language['Are you sure to delete this block?'];?>')"><strong>X</strong></a>
                        <?php
                                echo "</td>";
                                echo "</tr>"; 
                            }
                        ?>
                        </tbody>
                    </table>
                </div>        
            </div>      
        </div>
    <div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<?php include ('..\navbar\navbar2.php');?>
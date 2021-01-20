<?php
    require_once("dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: login/login.php');
    }

    if ($_SESSION["userType"] != '1'){
        header('location: login/login.php');
    }

    require_once("dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

    if(isset($_SESSION['ic']))
    {
        $id = $_SESSION['ic'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result)
        {
            echo "ERROR:  $conn->error";
            exit();
        } 
        $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo/favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
    <title><?php echo $language['Index']; ?></title>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="opacity: 1;filter: brightness(94%) contrast(114%);background: #0902d6;color: rgb(255,255,255);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="A.php">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span><?php echo $language['Management']; ?></span></div>
                </a>

                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span><?php echo $language['Dashboard']; ?></span></a><a class="nav-link" href="complaints/readComplaint.php"><i class="fas fa-user-circle"></i><span><?php echo $language['Complaint Management']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="users/readUser.php"><i class="fas fa-user"></i><span><?php echo $language['User Management']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="assets/selectblock.php"><i class="fas fa-table"></i><span><?php echo $language['Asset Management']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Rooms/roomlist.php"><i class="far fa-user-circle"></i><span><?php echo $language['Room Management']; ?></span></a><a class="nav-link" href="Blocks/blocklist.php"><i class="fa fa-building"></i><span><?php echo $language['Block Management']; ?></span></a><a class="nav-link" href="pdfprint/printmenu.php"><i class="fa fa-files-o"></i><span><?php echo $language['Download and Print']; ?></span></a></li>
                    </li><li class="nav-item"><a class="nav-link" href="grades/readGrade.php"><i class="fas fa-users-cog"></i><span><?php echo $language['Grade Management']; ?></span></a>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="margin: 2px;">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-0">
                            <?php 

                                if ($_SESSION['language'] == 'BI'){
                                   echo $row["postBI"];
                                }else if ($_SESSION['language'] == 'BM'){
                                    echo $row["postBM"];
                                }else{
                                    echo $row["postBM"];
                                }
                            ?>

                            &nbsp;<?php echo $language['Home']; ?></h3>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <div><br>
                            <a class="lang"id="bm" value="BM">BM|</a>
                            <a class="lang"id="bi" value="BI">BI</a> 
                            <script>
                                $('.lang').click(function(){
                                            var value = $(this).attr('value');
                                            $.ajax({
                                                type: 'POST',
                                                url: 'testing.php',
                                                data: {'action':'ajax_action','type':'post','lang': value },
                                                success: function(data) {
                                                   alert(data);
                                                    location.reload()
                                                    // $(this).css({'color' : 'red'});
                                                }
                                            });
                                });            
                            </script>
                            </div>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2">
                                    <?php echo $row["name"];?>
                                </span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.png">&nbsp;&nbsp;<i class="icon ion-android-settings"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="users/updateUser.php?id=<?php echo $row["u_userIC"]; ?>"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;<?php echo $language['Edit Profile']; ?></a>
                                        <a class="dropdown-item" href="users/changepwd.php?id=<?php echo $row["u_userIC"]; ?>"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;<?php echo $language['Change Password']; ?></a>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="login/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;<?php echo $language['Logout']; ?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;color: rgb(255,255,255);background: rgb(237,207,204);">
                                <a class="card-block stretched-link text-decoration-none" href="dashboard.php">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div> &nbsp;
                                            <img src="assets/img/dashboard-1739866-1481441.png" style="width: 113px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['DASHBOARD']; ?></strong><br></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                            <a class="card-block stretched-link text-decoration-none" href="complaints/readComplaint.php">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>
                                            <div class="row no-gutters align-items-center"> &nbsp;
                                             <img src="assets/img/2048413-200.png" style="width: 100px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['COMPLAINTS MANAGEMENT']; ?></strong></span>   
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                                <a class="card-block stretched-link text-decoration-none" href="users/readUser.php">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>
                                            <div class="row no-gutters align-items-center"></div>&nbsp;
                                            <img src="assets/img/img_382262.png"  style=" width: 59px;height: 100px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif; text-align: center; color: rgb(0,0,0);"><strong><?php echo $language['USER MANAGEMENT']; ?></strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                                <a class="card-block stretched-link text-decoration-none" href="assets/mainA.php">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>&nbsp;
                                            <img src="assets/img/223712-200.png"  style="width: 113px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['ASSET MANAGEMENT']; ?></strong><br></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                                <a class="card-block stretched-link text-decoration-none" href="Rooms/roomlist.php">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>
                                            <div class="row no-gutters align-items-center">&nbsp;&nbsp;
                                                <img src="assets/img/room%20(1).png"  style="width: 113px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['ROOM MANAGEMENT']; ?></strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                                 <a class="card-block stretched-link text-decoration-none" href="Blocks/blocklist.php">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"></div>&nbsp;
                                            <img src="assets/img/1710329-200.png" style="width: 113px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['BLOCK MANAGEMENT']; ?></strong></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                                <a class="card-block stretched-link text-decoration-none" href="pdfprint/printmenu.php" style="height: 169px;">
                                    <div class="row align-items-center no-gutters" style="padding: -9px;">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>
                                            <div class="text-white font-weight-bold h5 mb-0"></div>&nbsp;
                                            <img src="assets/img/print-outline.png"  style="width: 113px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['DOWNLOAD AND PRINT']; ?></strong><br></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-white text-justify shadow border-left-warning py-2" style="height: 169px;">
                                <a class="card-block stretched-link text-decoration-none" href="grades/readGrade.php" style="height: 169px;">
                                    <div class="row align-items-center no-gutters" style="padding: -9px;">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"></div>
                                            <div class="text-white font-weight-bold h5 mb-0"></div>&nbsp;
                                            <img src="assets/img/grade.png"  style="width: 113px;height: 104px;padding: -52px;margin: 5px;"><span class="text-center text-dark" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;text-align: center;color: rgb(0,0,0);"><strong><?php echo $language['GRADE MANAGEMENT']; ?></strong><br></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
                <script src="assets/js/script.min.js"></script>

</body>
</html>

<?php
}
?>
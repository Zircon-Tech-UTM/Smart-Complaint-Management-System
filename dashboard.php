<?php
    include 'duallanguage/language.php';
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
    
    date_default_timezone_set("Asia/Kuala_Lumpur");


    //user information
    $sql1 = "SELECT * FROM users WHERE u_userIC=".$_SESSION['ic'].";";

    $result1 = mysqli_query($conn, $sql1);

    if (!$result1)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: readUser.php");
    } 

    $row1 = mysqli_fetch_array($result1);

    //sql 3 elements in for firstrow
    $end = date('Y-m-d');
    $start = date('Y-m-d', strtotime('-7 days', strtotime($end)));
    $sqlONE = "SELECT COUNT(compID) AS NumberComp
                from complaints 
                WHERE proposedDate >= '$start'
                AND proposedDate <= '$end'";
    $resultONE = mysqli_query($conn, $sqlONE);    
    $NumberComp = mysqli_fetch_array($resultONE);

    $sql2 = "SELECT COUNT(compID) AS NumberCompSolved
            from complaints 
            WHERE c_status = 3
            AND setledDate >= '$start'
            AND setledDate <= '$end'";
    $result2 = mysqli_query($conn, $sql2);
    $NumberCompSolved = mysqli_fetch_array($result2);

    $sql3 = "SELECT COUNT(compID) AS NumberCompPend
            from complaints 
            WHERE c_status = '1'";
    $result3 = mysqli_query($conn, $sql3);
    $NumberCompPend = mysqli_fetch_array($result3);

    //sql for user table
    $sqlU = "SELECT postBI, postBM, userType, COUNT(*) AS num_User
            FROM `users` 
            GROUP BY userType";
    $resultU = mysqli_query($conn, $sqlU);

    //ICT complaint
    $sqlI = "SELECT s.s_nameBI, s.s_nameBM, COUNT(*) AS number
            FROM complaints c
            JOIN assets a
            ON c.c_assetID = a.a_assetID 
            JOIN status s
            ON c.c_status = s.s_statusID
            WHERE a.a_category = '1'
            GROUP BY c.c_status";
    $resultI = mysqli_query($conn, $sqlI);

    //non-ICT complaint
    $sqlN = "SELECT s.s_nameBI, s.s_nameBM, COUNT(*) AS number
            FROM complaints c
            JOIN assets a
            ON c.c_assetID = a.a_assetID 
            JOIN status s
            ON c.c_status = s.s_statusID
            WHERE a.a_category = '2'
            GROUP BY c.c_status";
    $resultN = mysqli_query($conn, $sqlN);

    //Room with most complaint
    $sqlR = "SELECT r.r_nameBI, r.r_nameBM, COUNT(*) AS number
            FROM complaints c
            JOIN rooms r
            ON c.c_roomID = r.r_roomID
            GROUP BY c.c_roomID
            ORDER BY number DESC
            LIMIT 0, 5";
    $resultR = mysqli_query($conn, $sqlR);          

    //Block with most complaint
    $sqlB = "SELECT b.b_nameBI, b.b_nameBM, COUNT(*) AS number
            FROM complaints c
            JOIN rooms r
            ON c.c_roomID = r.r_roomID
            JOIN blocks b
            ON r.blok = b.block_no
            GROUP BY r.blok
            ORDER BY number DESC
            LIMIT 0, 3";
    $resultB = mysqli_query($conn, $sqlB);
    
    //Asset with most compliant
    $sqlA = "SELECT a.a_nameBI, a.a_nameBM, COUNT(*) AS number
            FROM complaints c
            JOIN assets a
            ON c.c_assetID = a.a_assetID
            GROUP BY LOWER(a.a_nameBI)
            ORDER BY number DESC
            LIMIT 0, 10";
    $resultA = mysqli_query($conn, $sqlA);
    require_once("dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $language['MY DASHBOARD']; ?></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
        table {
            border-collapse:separate;
            border:solid black 1px;
            border-radius:6px;
            -moz-border-radius:6px;
        }

        td, th {
            border-left:solid black 1px;
            border-top:solid black 1px;
            padding: 10px;
            width: 80%;
            height: 60%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        th {
            background-color: #e4f2f7;
            border-top: none;
        }

        td:first-child, th:first-child {
            border-left: none;
        }
    </style>
</head>

<body id="page-top" style="background: var(--cyan);">
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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="opacity: 1;filter: brightness(94%) contrast(114%);background: #0902d6;color: rgb(255,255,255);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="A.php">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span><?php echo $language['MANAGEMENT'];?></span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="A.php"><i class="fas fa-home"></i><span><?php echo $language['Home']; ?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span><?php echo $language['MY DASHBOARD'];?></span></a><a class="nav-link" href="complaints\readComplaint.php"><i class="fas fa-user-circle"></i><span><?php echo $language['COMPLAINTS MANAGEMENT'];?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="users\readUser.php"><i class="fas fa-user"></i><span><?php echo $language['USER MANAGEMENT'];?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="assets\mainA.php"><i class="fas fa-table"></i><span><?php echo $language['ASSETS MANAGEMENT'];?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Rooms\roomlist.php"><i class="far fa-user-circle"></i><span><?php echo $language['ROOM MANAGEMENT'];?></span></a><a class="nav-link" href="Blocks\blocklist.php"><i class="fa fa-building"></i><span><?php echo  $language['BLOCK MANAGEMENT'];?></span></a><a class="nav-link" href="pdfprint\printmenu.php"><i class="fa fa-files-o"></i><span><?php echo  $language['DOWNLOAD AND PRINT'];?></span></a></li>
                    <li class="nav-item"><a class="nav-link" href="grades/readGrade.php"><i class="fas fa-users-cog"></i><span ><?php echo $language['GRADE MANAGEMENT']; ?></span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="margin: 2px;">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <div>
                            <br>
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
                                    <?php echo $row1["name"];?>
                                    
                                    <?php $default = "assets/img/avatars/avatar5.png";?>
                                    <?php $profile = "users/".$row1["u_img_path"]; ?>
                                </span><img class="border rounded-circle img-profile" src="<?php echo (isset($row1["u_img_path"]))? $profile: $default; ?>">&nbsp;&nbsp;<i class="icon ion-android-settings"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="profile/editprofile.php?id=<?php echo $_SESSION["ic"]; ?>"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;<?php echo $language['Edit Profile'];?></a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;<?php echo  $language['Change Password'];?></a>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="login/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;<?php echo $language['Logout'];?></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">                
                        <h2 class="font-weight-bold"><?php echo $language['KVPJB Complaint Inventory System'];?></h2>
                        <h5><?php echo date("Y-m-d");?></h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card bg-danger shadow border-left-success py-2" style="border-radius: 20px; height: 200px;">
                                <div class="card-body" style="height: 200px;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span class="text-white" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;"><?php echo $language['colourcard1']; ?><br></span></div>
                                            <div class="text-white font-weight-bold h5 mb-0"><span class="text-white" style="color: var(--danger);font-size: 34px;"><?php echo $NumberComp['NumberComp']; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card text-white bg-success text-justify shadow border-left-info py-2" style="border-radius: 20px; height: 200px;">
                                <div class="card-body" style="height: 200px;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span class="text-white" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;"><?php echo $language['colourcard2']; ?><br></span></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span class="text-white" style="font-size: 34px;"><?php echo $NumberCompSolved['NumberCompSolved']; ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card bg-info border-dark shadow border-left-warning py-2" style="border-radius: 20px; height: 200px;">
                                <div class="card-body" style="height: 200px;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span class="text-white" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;"><?php echo $language['colourcard3']; ?><br></span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span class="text-white" style="font-size: 34px;"><?php echo $NumberCompPend['NumberCompPend']; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- table user -->
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <div class="card shadow mb-4" >
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0" style = "text-align:center;"><?php echo $language['table'];?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded">   
                                        <table>
                                            <tr>
                                            <th style="bold; text-align:center;"><?php echo $language['User'];?></th>
                                            <th style = "bold; text-align:center;"><?php echo $language['Number'];?></th>
                                            </tr>
                                            <?php
                                                while($num_User= mysqli_fetch_array($resultU)){
                                                echo "<tr>";
                                                if ($_SESSION['language'] == 'BI'){
                                                   echo "<td>".$num_User['postBI']."</td>";
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo "<td>".$num_User['postBM']."</td>";
                                                }else{
                                                    echo "<td>".$num_User['postBI']."</td>";
                                                }
                                                
                                                echo "<td style = 'text-align:center;'>".$num_User['num_User']."</td>";
                                                    echo "</tr>";   
                                                }                              
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Asset Bar -->
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <script>
                                //Asset bar chart
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawBar3);

                                function drawBar3() {

                                var data5 = google.visualization.arrayToDataTable([
                                    ["<?php echo $language["Assets's name"];?>", '<?php echo $language['Number of Complaint'];?>'],     
                                    <?php
                                        while($rowA = mysqli_fetch_array($resultA))
                                        {
                                            if ($_SESSION['language'] == 'BI'){
                                                echo "['".$rowA['a_nameBI']."', ".$rowA['number']."],";
                                             }else if ($_SESSION['language'] == 'BM'){
                                                echo "['".$rowA['a_nameBM']."', ".$rowA['number']."],";
                                             }else{
                                                echo "['".$rowA['a_nameBI']."', ".$rowA['number']."],";
                                             }
                                        }
                                    ?>
                                ]);

                                var options5 = {
                                    colors: ['yellow'],
                                    bars: 'horizontal',
                                    'backgroundColor': { fill:'#f8f9fc' }
                                };

                                var chart5 = new google.charts.Bar(document.getElementById('barchart3'));

                                chart5.draw(data5, options5);
                                } 
                            </script>
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0" style = "text-align:center;"><?php echo $language['bar1'];?></h6>
                                </div >
                                <div class="card-body">
                                    <div class="border rounded">
                                        <div id="barchart3" style="padding: 5px; width: 90%; height: 60%;"></div><hr>
                                    </div>   
                                </div>                  
                            </div>
                        </div>
                        <!-- Room Bar -->
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <script>
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawBar1);

                                //Room bar chart
                                function drawBar1() {

                                var data3 = google.visualization.arrayToDataTable([
                                    ["<?php echo $language["Room's name"];?>", '<?php echo $language['Number of Complaint'];?>'],     
                                    <?php
                                        while($rowR = mysqli_fetch_array($resultR))
                                        {
                                            if ($_SESSION['language'] == 'BI'){
                                                echo "['".$rowR['r_nameBI']."', ".$rowR['number']."],";
                                            }else if ($_SESSION['language'] == 'BM'){
                                                echo "['".$rowR['r_nameBM']."', ".$rowR['number']."],";
                                            }else{
                                                echo "['".$rowR['r_nameBI']."', ".$rowR['number']."],";
                                            }
                                        }
                                    ?>
                                ]);

                                var options3 = {
                                    chart3: {
                                    width: 1180,
                                    height: 200,
                                    },
                                    colors: ['red'],
                                    bars: 'horizontal'
                                };

                                var chart3 = new google.charts.Bar(document.getElementById('barchart1'));

                                chart3.draw(data3, google.charts.Bar.convertOptions(options3));
                                }
                            </script>
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">                    
                                    <h6 class="text-primary font-weight-bold m-0" style = "text-align:center;"><?php echo $language['bar2'];?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded">
                                        <div id="barchart1" style = "padding: 5px; width: 90%; height : 60%;" ></div><hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Block bar -->
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <script>
                                //Block bar chart
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawBar2);

                                function drawBar2() {

                                var data4 = google.visualization.arrayToDataTable([
                                    ["<?php echo $language["Blocks' name"];?>", '<?php echo $language['Number of Complaint'];?>'],     
                                    <?php
                                        while($rowB = mysqli_fetch_array($resultB))
                                        {
                                            if ($_SESSION['language'] == 'BI'){
                                                echo "['".$rowB['b_nameBI']."', ".$rowB['number']."],";
                                            }else if ($_SESSION['language'] == 'BM'){
                                                echo "['".$rowB['b_nameBM']."', ".$rowB['number']."],";
                                            }else{
                                                echo "['".$rowB['b_nameBI']."', ".$rowB['number']."],";
                                            }
                                        }
                                    ?>
                                ]);

                                var options4 = {
                                    title: 'Blocks with most complaints (Top 3)',
                                    hAxis: {
                                        title: "Blocks' name"
                                    },
                                    vAxis:{
                                        title:  "Number of Complaints"
                                    },
                                    bars: 'horizontal',
                                    colors: ['orange']
                                };

                                var chart4 = new google.charts.Bar(document.getElementById('barchart2'));

                                chart4.draw(data4, options4);
                                }
                            </script>
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">                       
                                    <h6 class="text-primary font-weight-bold m-0" style = "text-align:center;"><?php echo $language['bar3'];?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded">
                                        <div id="barchart2" style = "padding: 5px; width: 90% height: 60%;" ></div><hr> 
                                    </div>
                                </div>     
                            </div>
                        </div>
                        <!-- ICT Pie -->
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0" style = "text-align:center;"><?php echo $language['pie1'];?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded">
                                        <script>
                                            google.charts.load('current', {'packages':['corechart']});
                                            google.charts.setOnLoadCallback(drawPie1);

                                            function drawPie1() {

                                                var data1 = google.visualization.arrayToDataTable([
                                                ['<?php echo $language['Complaint Status'];?>', '<?php echo $language['Number of Complaint'];?>'],
                                                <?php
                                                while($rowI = mysqli_fetch_array($resultI))
                                                {
                                                    if ($_SESSION['language'] == 'BI'){
                                                        echo "['".$rowI['s_nameBI']."', ".$rowI['number']."],";
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo "['".$rowI['s_nameBM']."', ".$rowI['number']."],";
                                                    }else{
                                                        echo "['".$rowI['s_nameBI']."', ".$rowI['number']."],";
                                                    }
                                                }
                                                ?>
                                                ]);

                                                var options1 = {
                                                title: '<?php echo $language["Status of ICT Complaints"];?>'
                                                };

                                                var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

                                                chart1.draw(data1, options1);
                                            }
                                        </script>
                                        <div id="piechart1" style = "padding: 5px; width: 90% height: 60%;" ></div><hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Non-ICT Pie -->
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0" style = "text-align:center;"><?php echo $language['pie2'];?></h6>
                                </div>
                                    <div class="card-body">
                                        <div class="border rounded">
                                            <script>
                                                google.charts.load('current', {'packages':['corechart']});
                                                google.charts.setOnLoadCallback(drawPie2);
                                                function drawPie2() {

                                                var data2 = google.visualization.arrayToDataTable([
                                                    ['<?php echo $language['Complaint Status'];?>', '<?php echo $language['Number of Complaint'];?>'],
                                                    <?php
                                                    while($rowN = mysqli_fetch_array($resultN))
                                                    {
                                                        if ($_SESSION['language'] == 'BI'){
                                                            echo "['".$rowN['s_nameBI']."', ".$rowN['number']."],";
                                                        }else if ($_SESSION['language'] == 'BM'){
                                                            echo "['".$rowN['s_nameBM']."', ".$rowN['number']."],";
                                                        }else{
                                                            echo "['".$rowN['s_nameBI']."', ".$rowN['number']."],";
                                                        }
                                                    }
                                                    ?>
                                                ]);

                                                var options2 = {
                                                    title: '<?php echo $language["Status of non-ICT Complaints"];?>'
                                                };

                                                var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

                                                chart2.draw(data2, options2);
                                                }
                                            </script>
                                            <div id="piechart2" style = "padding: 5px; width: 90% height: 60%;" ></div><hr>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>

<?php include ('navbar\navbar2.php'); ?>
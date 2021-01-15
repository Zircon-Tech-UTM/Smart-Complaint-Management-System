<?php
    include ('../dbconfig.php');
    date_default_timezone_set("Asia/Kuala_Lumpur");

    //sql 3 elements in for firstrow
    $end = date('Y-m-d');
    $start = date('Y-m-d', strtotime('-7 days', strtotime($end)));
    $sql1 = "SELECT COUNT(compID) AS NumberComp
                from complaints 
                WHERE proposedDate >= '$start'
                AND proposedDate <= '$end'";
    $result1 = mysqli_query($conn, $sql1);    
    $NumberComp = mysqli_fetch_array($result1);

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
    $sqlU = "SELECT postBI, userType, COUNT(*) AS num_User
            FROM `users` 
            GROUP BY userType";
    $resultU = mysqli_query($conn, $sqlU);

    //ICT complaint
    $sqlI = "SELECT s.s_nameBI , COUNT(*) AS number
            FROM complaints c
            JOIN assets a
            ON c.c_assetID = a.a_assetID 
            JOIN status s
            ON c.c_status = s.s_statusID
            WHERE a.a_category = '1'
            GROUP BY c.c_status";
    $resultI = mysqli_query($conn, $sqlI);

    //non-ICT complaint
    $sqlN = "SELECT s.s_nameBI , COUNT(*) AS number
            FROM complaints c
            JOIN assets a
            ON c.c_assetID = a.a_assetID 
            JOIN status s
            ON c.c_status = s.s_statusID
            WHERE a.a_category = '2'
            GROUP BY c.c_status";
    $resultN = mysqli_query($conn, $sqlN);

    //Room with most complaint
    $sqlR = "SELECT r.r_nameBI, COUNT(*) AS number
            FROM complaints c
            JOIN rooms r
            ON c.c_roomID = r.r_roomID
            GROUP BY c.c_roomID
            ORDER BY number DESC
            LIMIT 0, 5";
    $resultR = mysqli_query($conn, $sqlR);          

    //Block with most complaint
    $sqlB = "SELECT b.b_nameBI, COUNT(*) AS number
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
    $sqlA = "SELECT a.a_nameBI, COUNT(*) AS number
            FROM complaints c
            JOIN assets a
            ON c.c_assetID = a.a_assetID
            GROUP BY LOWER(a.a_nameBI)
            ORDER BY number DESC
            LIMIT 0, 10";
    $resultA = mysqli_query($conn, $sqlA);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        table, th, td {
            padding: 10px;
            border: 1px solid black;
            width: 80%;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        #bar1{
            width: 80%;
        }

    </style>
</head>

<body id="page-top" style="background: var(--cyan);">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="opacity: 1;filter: brightness(94%) contrast(114%);background: #0902d6;color: rgb(255,255,255);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>ADMIN</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a><a class="nav-link" href="register.html"><i class="fas fa-user-circle"></i><span>Complaint Management</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fas fa-user"></i><span>User Management</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="table.html"><i class="fas fa-table"></i><span>Asset Managemnt</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html"><i class="far fa-user-circle"></i><span>Room Management</span></a><a class="nav-link" href="login.html"><i class="fa fa-building"></i><span>Block Management</span></a><a class="nav-link" href="login.html"><i class="fa fa-files-o"></i><span>Download And Print</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-0">My Dashboard</h3>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
            
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">Siti</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul><i class="icon ion-android-settings"></i>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">                
                        <input type="date" id = "dashDate" name = "dashDate" value = "<?php echo date("Y-m-d");?>" disabled>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-danger shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span class="text-white" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;">NEW COMPLAINTS IN PASS 7 DAYS<br></span></div>
                                            <div class="text-white font-weight-bold h5 mb-0"><span class="text-white" style="color: var(--danger);font-size: 34px;"><?php echo $NumberComp['NumberComp']; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card text-white bg-success text-justify shadow border-left-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span class="text-white" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;">COMPLAINTS SOLVED IN PASS 7 DAYS<br></span></div>
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
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card bg-info border-dark shadow border-left-warning py-2" style="height: 159px;">
                                <div class="card-body" style="height: 135px;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span class="text-white" style="width: -4px;font-size: 20px;font-family: Nunito, sans-serif;">TOTAL COMPLAINTS PENDING<br></span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span class="text-white" style="font-size: 34px;"><?php echo $NumberCompPend['NumberCompPend']; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id = "bar1">
                            <script>
                                //Asset bar chart
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawBar3);

                                function drawBar3() {

                                var data5 = google.visualization.arrayToDataTable([
                                    ["Assets's name", 'Number of Complaint'],     
                                    <?php
                                        while($rowA = mysqli_fetch_array($resultA))
                                        {
                                            echo "['".$rowA['a_nameBI']."', ".$rowA['number']."],";
                                        }
                                    ?>
                                ]);

                                var options5 = {
                                    colors: ['yellow'],
                                    bars: 'horizontal'
                                };

                                var chart5 = new google.charts.Bar(document.getElementById('barchart3'));

                                chart5.draw(data5, options5);
                                } 
                            </script>
                            <h2 style = "text-align:center; font-family:'Garamond, serif';">Assets with most complaints (Top 10)</h2>
                            <div id="barchart3" style = "padding: 5px;" ></div><hr>
                        </div>
                        
                        <div>
                            <script>
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawBar1);

                                //Room bar chart
                                function drawBar1() {

                                var data3 = google.visualization.arrayToDataTable([
                                    ["Room's name", 'Number of Complaint'],     
                                    <?php
                                        while($rowR = mysqli_fetch_array($resultR))
                                        {
                                            echo "['".$rowR['r_nameBI']."', ".$rowR['number']."],";
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
                            <h2 style = "text-align:center; font-family:'Garamond, serif';">Rooms with most complaints (Top 5)</h2>
                            <div id="barchart1" style = "padding: 5px; width : 1180px; height : 300px;" ></div><hr>
                        </div>
                        <div>
                            <script>
                                //Block bar chart
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawBar2);

                                function drawBar2() {

                                var data4 = google.visualization.arrayToDataTable([
                                    ["Block's name", 'Number of Complaint'],     
                                    <?php
                                        while($rowB = mysqli_fetch_array($resultB))
                                        {
                                            echo "['".$rowB['b_nameBI']."', ".$rowB['number']."],";
                                        }
                                    ?>
                                ]);

                                var options4 = {
                                    title: 'Blocks with most complaints (Top 3)',
                                    width: 1150,
                                    height: 200,
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
                            <h2 style = "text-align:center; font-family:'Garamond, serif';">Blocks with most complaints (Top 3)</h2>
                            <div id="barchart2" style = "padding: 5px; width : 1180px; height : 250px;" ></div><hr>
                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">ICT Complaints Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded">
                                        <script>
                                            google.charts.load('current', {'packages':['corechart']});
                                            google.charts.setOnLoadCallback(drawPie1);

                                            function drawPie1() {

                                                var data1 = google.visualization.arrayToDataTable([
                                                ['Complaint Status', 'Number of Complaint'],
                                                <?php
                                                while($rowI = mysqli_fetch_array($resultI))
                                                {
                                                    echo "['".$rowI['s_nameBI']."', ".$rowI['number']."],";
                                                }
                                                ?>
                                                ]);

                                                var options1 = {
                                                title: 'Status of ICT Complaints'
                                                };

                                                var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

                                                chart1.draw(data1, options1);
                                            }
                                        </script>
                                        <div id="piechart1" style = "padding: 5px; width : 450px; height : 300px;" ></div><hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto col-lg-7 col-xl-6" style="width: 590px;">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Non-ICT Complaints Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded">
                                            <script>
                                                google.charts.load('current', {'packages':['corechart']});
                                                google.charts.setOnLoadCallback(drawPie2);
                                                function drawPie2() {

                                                var data2 = google.visualization.arrayToDataTable([
                                                    ['Complaint Status', 'Number of Complaint'],
                                                    <?php
                                                    while($rowN = mysqli_fetch_array($resultN))
                                                    {
                                                    echo "['".$rowN['s_nameBI']."', ".$rowN['number']."],";
                                                    }
                                                    ?>
                                                ]);

                                                var options2 = {
                                                    title: 'Status of non-ICT Complaints',
                                                    pieHole: 0.4
                                                };

                                                var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

                                                chart2.draw(data2, options2);
                                                }
                                            </script>
                                            <div id="piechart2" style = "padding: 5px; width : 450px; height : 300px;" ></div><hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4"></div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">TOTAL NUMBER OF USESR</h6>
                                </div>
                                <div padding-left:10px>
                                    <table>
                                        <tr>
                                        <th style="bold; text-align:center;">User</th>
                                        <th style = "bold; text-align:center;">Number</th>
                                        </tr>
                                        <?php
                                            while($num_User= mysqli_fetch_array($resultU)){
                                            echo "<tr>";
                                            echo "<td>".$num_User['postBI']."</td>";
                                            echo "<td style = 'text-align:center;'>".$num_User['num_User']."</td>";
                                                echo "</tr>";   
                                            }                              
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
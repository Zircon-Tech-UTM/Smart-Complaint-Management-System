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
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
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
<html lang="en" style="opacity: 1;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Home</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <title>Admin Main Page</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="opacity: 1;filter: brightness(94%) contrast(114%);background: #0902d6;color: rgb(255,255,255);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>ADMIN</span></div>
                </a> 

                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a><a class="nav-link" href="complaints/readComplaint.php"><i class="fas fa-user-circle"></i><span>Complaint Management</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="users/readUser.php"><i class="fas fa-user"></i><span>User Management</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="assets/main.php"><i class="fas fa-table"></i><span>Asset Managemnt</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Rooms/roomlist.php"><i class="far fa-user-circle"></i><span>Room Management</span></a><a class="nav-link" href="Blocks/blocklist.php"><i class="fa fa-building"></i><span>Block Management</span></a><a class="nav-link" href="#"><i class="fa fa-files-o"></i><span>Download And Print</span></a></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="margin: 2px;">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h3 class="text-dark mb-0">Admin Home</h3>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2">
                                    <?php echo $row["name"]; 
                                    ?>
                                </span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar5.png">&nbsp;&nbsp;<i class="icon ion-android-settings"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="users/updateUser.php?id=<?php echo $row["u_userIC"]; ?>"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="login/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
<?php
}
?>

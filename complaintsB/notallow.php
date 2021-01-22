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

    include("../navbar/navbarB1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['ZirconTech']; ?></title>
</head>
<style>
    .help-block{    
        color: red;
    }
    img{
        width: 200px;
        height: 200px;
    }
</style>
<body id="page-top">

    <div class="container-fluid">
        <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Complaint Form']; ?></h3
        >
        <h4><?php echo $language["You are not assigned as PIC of any room yet"]; ?></h4>
    </div>

    <?php
        if (!empty($sqlErr)){
    ?>
        <script>
            let error = "<?php echo $sqlErr; ?>";
            alert(error);
        </script>
    <?php
    
        }
    ?>
</body>
</html>

<?php
    include("../navbar/navbar2.php");
?>
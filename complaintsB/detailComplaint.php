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
    include("../navbar/navbarB1.php");//yc add
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM complaints, rooms, blocks 
                WHERE complaints.c_roomID = rooms.r_roomID 
                AND rooms.blok = blocks.block_no  
                AND compID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if ($result){
            $row = mysqli_fetch_array($result);

            $pDate = explode(" ", $row["proposedDate"]);
            $sDate = explode(" ", $row["setledDate"]);
        
        
?>          


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Zircon Tech']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<style>
    img{
        width: 200px;
        height: 200px;
    }
</style>
<body>
    <div class="container">
        <h1><strong><?php echo $language['Complaints ID:']; ?> </strong><?php echo $row["compID"];?></h1>

        <img src="<?php echo "../complaints/".$row["c_img_path"];?>" alt="image"><br>

        <span><?php echo $language['Building:']; ?> </span><p><?php echo $row["blok"];?></p>
        <span><?php echo $language['Room:']; ?> </span><p><?php echo $row["r_nameBI"];?></p>

        <ul class="list-inline">
            <li class="list-inline-item"><p class="lead"><?php echo $language['Proposed Date:']; ?></p><p><?php echo $pDate[0];?></p></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item">
                <p class="lead"><?php echo $language['Settled Date:']; ?> </p><p><?php if(empty($sDate[0])){echo "-";} else {echo $sDate[0];}?></p>
            </li>
        </ul>
        
        <p>
            Status: 
            <?php 
                $sql2 = "SELECT * FROM status WHERE s_statusID = '".$row["c_status"]."'";

                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_array($result2);

                echo $row2["s_nameBI"];
                
            ?>
        
        </p>

        <p class="lead"><?php echo $language['Details:']; ?> </p><p><?php echo $row['detail']; ?></p>

        <a href="modifyComplaint.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm"><?php echo $language['Edit']; ?></a>
        <a href="deleteComplaint.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm"><?php echo $language['Delete']; ?></a>
    </div>
</body>
</html>



<?php
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 6; location: readComplaint.php");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 5; location: readComplaint.php");
    }
    mysqli_close($conn);
?>
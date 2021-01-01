<?php
    include("../CRUDusers/UsersBack/dbconfigUser.php");

    $password = $_POST['password'];
    

    $sql = "UPDATE users
            SET  pwd='$password'
            WHERE u_userIC='$IC'";

    echo '\n';
    echo $sql;
    echo '\n';
    
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        header("location: otherUser.php");
        exit();
    } 
    else
    {
        echo "ERROR: $conn->error";
    }

    mysqli_close($conn);
?>
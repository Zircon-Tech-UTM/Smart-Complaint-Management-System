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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Block</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
<h1>Create a new Room</h1>
    <div class="container">
        <form method="POST" action="createblockprocess.php">
            <div class="form-group">
                <label for="block_no">Block ID</label>
                        <input type="text" class="form-control" id="block_no" placeholder="Enter block ID" name="block_no" required="A block must have a unique ID">
            </div>

            <div class="form-group">
            <label for="name">Block's Name</label>
                <input type="text" class="form-control" id="nameBI" placeholder="Enter name in English" name="nameBI" required="A block must have a name.">
            </div>

            <div class="form-group">
            <label for="nama">Nama Blok</label>
                <input type="text" class="form-control" id="nameBM" placeholder="Enter name in Malay" name="nameBM" required="A block must have a name.">
            </div>

            <div class="form-group">
            <label for="location">Location</label>
                <select name = 'loc' class="form-select" aria-label="Disabled select example">
                    <option selected disabled>Location</option>
                    <option value="1">Asrama</option>
                    <option value="2">Kolej</option>
                    <option value="3">Others</option>
                </select>             
            </div>


            <br>

            <button type="submit" class="btn btn-default">Create</button>&nbsp
            <button type="reset" class="btn btn-warning">Reset</button>
    </div>

</body>
</html>
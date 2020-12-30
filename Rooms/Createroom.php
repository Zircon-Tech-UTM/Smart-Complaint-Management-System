<?php

include ('dbconnect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
    <h1>Create a new Room</h1>
    <div class="container">
        <form method="POST" action="createroomprocess.php">
            <div class="form-group">
                <label for="roomID">Room ID</label>
                        <input type="text" class="form-control" id="roomID" placeholder="Enter room ID" name="roomID" required="A room must have a unique ID">
            </div>

            <div class="form-group">
            <label for="name">Room's Name</label>
                <input type="text" class="form-control" id="nameBI" placeholder="Enter name in English" name="nameBI" required="A room must have a name.">
            </div>

            <div class="form-group">
            <label for="nama">Nama Bilik</label>
                <input type="text" class="form-control" id="nameBM" placeholder="Enter name in Malay" name="nameBM" required="A room must have a name.">
            </div>

            <div class="form-group">
            <label for="PIC">Person in charge's ID</label>
                <input type="text" class="form-control" id="PIC" placeholder="Enter PIC'S user ID" name="PICid" required="A room must have a person in charge.">
            </div>

            <div class="form-group">
                <label for="sel1">Block</label>
                  <?php
                    $sql = "SELECT * FROM blocks";
                    $result = mysqli_query($conn, $sql);
                    
                    echo"<select name='block' class='form-control' id='sel1'>";
                    echo"<option selected disabled>Block</option>";
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<option value='".$row['block_no']."'>".$row['b_nameBI']."</option>";
                    }
                    echo"</select>";
                  ?>
            </div>

            <div class="form-group">
            <label for="location">Location</label>
                <select name = 'loc' class="form-select" aria-label="Disabled select example">
                    <option selected disabled>Location</option>
                    <option value="1">Asrama</option>
                    <option value="2">Kolej</option>
                </select>             
            </div>
    
            <!-- <div class="form-group"> 
            <label for="img">Image of the room (if any)</label>
                <input type="file" name="img" id="img">            
            </div>-->

            <br>

            <button type="submit" class="btn btn-default">Create</button>
            <button type="reset" class="btn btn-warning">Reset</button>

    </div>

</body>
</html>
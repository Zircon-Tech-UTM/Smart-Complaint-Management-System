<?php

    include ('dbconnect.php');

    if(isset($_GET['id']))
    {
        $bid = $_GET['id'];
    }

    $sql = "SELECT * FROM blocks
            JOIN rooms
            ON block_no = blok
            WHERE block_no = '$bid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Block</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<h1>Edit Block</h1>
    <div class="container">
        <form method="POST" action="blockmodifyprocess.php">
            <div class="form-group">
            <label for="block_no">Block ID</label>
                <input type="text" class="form-control" id="block_no" placeholder="Enter block ID" name="block" required="A block must have a unique ID" value = "<?php echo $row['block_no'];?>"disabled>
            </div>
            <input type="hidden" class="form-control" id="block_no" placeholder="Enter block ID" name="block" required="A block must have a unique ID" value = "<?php echo $row['block_no'];?>">

            <div class="form-group">
            <label for="name">Block's Name</label>
                <input type="text" class="form-control" id="nameBI" placeholder="Enter name in English" name="nameBI" required="A block must have a name." value = "<?php echo $row['b_nameBI'];?>">
            </div>

            <div class="form-group">
            <label for="nama">Nama Blok</label>
                <input type="text" class="form-control" id="nameBM" placeholder="Enter name in Malay" name="nameBM" required="A block must have a name." value = "<?php echo $row['b_nameBM'];?>">
            </div>

            <div class="form-group">
            <label for="location">Location</label>
                <select name = 'loc' class="form-select" aria-label="Default select example">
                <option selected disabled>Location</option>
                    <?php
                    $array = ['1','2', '3'];
                    foreach($array as $arr)
                    {
                        if($arr == $row['location'])
                        {
                            echo"<option selected = 'selected' value=".$arr.">";
                            if($arr == '1')
                            {
                                echo "Asrama";
                            }
                            else if($arr == '2')
                            {
                                echo "Kolej";
                            }
                            else if($arr == '3')
                            {
                                echo "Others";
                            }
                            echo "</option>";
                        }
                        else
                        {
                            echo"<option value=".$arr.">";
                            if($arr == '1')
                            {
                                echo "Asrama";
                            }
                            else if($arr == '2')
                            {
                                echo "Kolej";
                            }
                            else if($arr == '3')
                            {
                                echo "Others";
                            }
                            echo "</option>";
                        }
                    }
                       
                    ?>
                </select>             
            </div>
            <br>

            <button type="submit" class="btn btn-default">Update</button>
            <button type="reset" class="btn btn-warning">Reset to initial details</button>

</body>
</html>
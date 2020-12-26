<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZirconTech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

        <form action="complaintsBack\createPro.php" method="POST">
            <div class="mb-3">
                <label for="complainantName" class="form-label">Name:</label>
                <input type="text" name="name" id="complainantName" class="form-control form-control-lg" placeholder="complainant's name">
            </div>

            <div>
                <label for="complaintDate" class="form-label">Date:</label>
                <input type="date" name="date" id="complaintDate" value="">
            </div><br>

            <div>
                <label for="radio" class="form-label">Buildings Category</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" value="1" class="form-check-input" id="radio1" name="building">
                    <label for="radio1" class="form-check-label">Asrama</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" value="2" class="form-check-input" id="radio2" name="building">
                    <label for="radio2" class="form-check-label">Kolej</label>
                </div>
            </div><br>

            <div>
                <label for="check" class="form-label">Location</label>
                <select name="location" id="check" class="form-select form-select-lg mb-3" aria-label="form-select-lg example">
                    <option value="" selected>Choose an option</option>
                    <option value="1">Block A</option>  <!-- Block A -->
                    <option value="2">Block B</option>  <!-- Block B -->
                    <option value="3">Block C</option>  <!-- Block C -->
                    <option value="4">Block M</option>  <!-- Block D -->
                    <option value="5">Block N</option>  <!-- Block E -->
                    <option value="6">Block R</option>  <!-- Block F -->
                    <option value="7">Block S</option>  <!-- SURAU -->
                    <option value="8">Main Hall</option>  <!-- Dinig Hall (1st Floor) -->
                    <option value="9">Others</option>  <!-- Dinig Hall (Ground Floor) -->
                    <!-- others -->
                </select>
            </div>

            <div class="mb-3">
                <label for="roomtName" class="form-label">Room Name:</label>
                <input type="text" name="room" id="roomName" class="form-control form-control-lg" placeholder="Name of the Room">
            </div>

            <div class="mb-3">
                <label for="check2" class="form-label">Type of Damage</label>
                <select name="damage" id="check2" class="form-select form-select-lg mb-3" aria-label="form-select-lg example">
                    <option value="" selected>Choose an option</option>
                    <option value="1">Door</option>  
                    <option value="2">Glass</option> 
                    <option value="3">Light</option>  
                    <option value="4">Fan</option>  
                    <option value="5">Toilet</option> 
                    <!-- type of damages -->
                </select>
            </div>

            <div>
                <label for="totalDamage" class="form-label">Total</label>
                <input type="text" name="total" id="totalDamage" class="form-control" placeholder="Total Number of Damages">
            </div><br>

            <div class="mb-3">
                <label for="complainantDetail" class="form-label">Detail:</label>
                <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg" placeholder="complainant's detail">
            </div>
            

            <!-- <div class="input-group">
                <input type="file" class="form-control" id="imageDamage" name="image" aria-describedby="inputGroupFile" aria-label="Upload">
            </div> -->
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="landing.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</body>
</html>

<!-- 
userID
buildings ID
roomID
pDate
sDate
Type of damage
Total
detail
status
img path
-->
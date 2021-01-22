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

    // include("complaintsBack/createPro.php");
    


    include("complaintsBack/createPro.php");
    include("../navbar/navbar1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    $sql2 = "SELECT * FROM blocks";
    $result2 = mysqli_query($conn, $sql2);

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['ZirconTech']; ?></title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
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
        <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Complaint Form']; ?></h3>

        <form action="createComplaint.php" enctype="multipart/form-data" method="POST">

            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><?php echo $language['Complaint Detail']; ?></p>
                    </div>

                    <div class="card-body">
                        <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $_SESSION['ic']; ?>">

                        <div class="mb-3">
                            <label for="proposedDate" class="form-label <?php echo (!empty($dateErr)) ? 'is-invalid' : ''; ?>"><strong><?php echo $language['Date']; ?></strong></label>
                            <input type="date" name="date" id="proposedDate" class="form-control form-control-lg" value="<?php echo $date; ?>" max="<?php echo date("Y-m-d"); ?>">
                            <span class="help-block"><?php echo $dateErr;?></span>
                        </div>

                        <div>
                            <label for="blocks" class="form-label"><strong><?php echo $language['Blocks']; ?></strong></label><br>
                            <select class="form-select <?php echo (!empty($blocksErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="blocks" name="blocks" value="<?php echo $blocks; ?>">
                                <option value="" selected><?php echo $language['Open this select menu']; ?></option>
                                <?php
                                    while ($row2 = mysqli_fetch_array($result2)){
                                ?>
                                        <option value="<?php echo $row2['block_no']; ?>"><?php echo $row2['b_name'.$_SESSION["language"].'']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <span class="help-block"><?php echo $blocksErr;?></span>
                        </div><br>

                        <div>
                            <label for="rooms" class="form-label"><strong><?php echo $language['Rooms']; ?></strong></label><br>
                            <select class="form-select <?php echo (!empty($roomsErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="rooms" name="rooms" value="<?php echo $rooms; ?>">
                                <option value="" selected><?php echo $language['Please Choose A Block']; ?></option>
                            </select>
                            <span class="help-block"><?php echo $roomsErr;?></span>
                        </div><br>

                        <div>
                            <label for="assets" class="form-label"><strong><?php echo $language['Assets']; ?></strong></label><br>
                            <select class="form-select <?php echo (!empty($assetsErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="assets" name="assets" value="<?php echo $assets; ?>">
                                <option value="" selected><?php echo $language['Please Choose A Room']; ?></option>
                            </select>
                            <span class="help-block"><?php echo $assetsErr;?></span>
                        </div><br>

                        <script type="text/javascript">
                            document.getElementById('blocks').addEventListener('change', loadRooms);
                            document.getElementById('rooms').addEventListener('change', loadAssets);

                            function loadRooms(){
                                let block = document.getElementById('blocks').value;

                                let xhr = new XMLHttpRequest();
                                xhr.open('GET', `complaintsBack/rooms.php?blocks=${block}`, true);
                                
                                xhr.onreadystatechange = function(){
                                    if (this.status === 200 && this.readyState === 4){
                                        let rooms = JSON.parse(this.responseText);

                                        let lang = "<?php echo $_SESSION["language"]; ?>";

                                        output = '';
                                        
                                        if (lang === 'BI'){
                                            output+= `<option selected>Open this select menu</option>`;
                                            for (var i in rooms){
                                                output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBI}</option>`;
                                            }
                                        }else{
                                            output+= `<option selected>Tunjuk menu</option>`;
                                            for (var i in rooms){
                                                output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBM}</option>`;
                                            }
                                        }

                                        
                                        document.getElementById('rooms').innerHTML = output;
                                        
                                        loadAssets();
                                    }else if(this.status == 404){
                                        console.log('Fail');
                                    }
                                }
                                xhr.send();
                            }

                            function loadAssets(){
                                let room = document.getElementById('rooms').value;

                                let xhr = new XMLHttpRequest();
                                xhr.open('GET', `complaintsBack/assets.php?rooms=${room}`, true);
                                
                                xhr.onreadystatechange = function(){
                                    if (this.status === 200 && this.readyState === 4){
                                        let result = JSON.parse(this.responseText);
                                        console.log(result);

                                        let lang2 = "<?php echo $_SESSION["language"]; ?>";

                                        output = '';
                                        
                                        if (lang2 === 'BI'){
                                            output+= `<option selected>Open this select menu</option>`;
                                            for (var i in result){
                                                output+= `<option value="${result[i].a_assetID}">${result[i].a_nameBI}</option>`;
                                            }
                                        }else{
                                            output+= `<option selected>Tunjuk Menu</option>`;
                                            for (var i in result){
                                                output+= `<option value="${result[i].a_assetID}">${result[i].a_nameBM}</option>`;
                                            }
                                        }

                                        document.getElementById('assets').innerHTML = output;
                                    }else if(this.status == 404){
                                        console.log('Fail');
                                    }
                                }
                                xhr.send();
                            }
                        </script>

                        <div>
                            <label for="complainantDetail" class="form-label"><strong><?php echo $language['Detail']; ?></strong></label>
                            <input type="text" name="detail" id="complainantDetail" class="form-control <?php echo (!empty($detailErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language["Complainant's detail"]; ?>" value="<?php echo $detail; ?>">
                            <span class="help-block"><?php echo $detailErr;?></span>
                        </div>

        
                        <div class="form-group">
                            <label class="control-label form-label"><strong><?php echo $language['Complaint Image']; ?></strong></label>
                            <input class="form-control" type="file" name="image" onchange="readURL(this);" />
                            <img id="blah" src="#" alt="<?php echo $language["complaint image"]; ?>" />
                            <span class="help-block"><?php echo $errMSG;?></span>
                        </div>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#blah')
                                            .attr('src', e.target.result)
                                            .width(150)
                                            .height(200);
                                    };

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

            <input type="submit" class="btn btn-primary" value="<?php echo $language['Submit']; ?>">            <input type="reset" name="clear" value="<?php echo $language['Clear']; ?>"class="btn btn-warning"> 
            <a href="readComplaint.php" class="btn btn-danger float-right"><?php echo $language['Cancel']; ?></a>
        </form>
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
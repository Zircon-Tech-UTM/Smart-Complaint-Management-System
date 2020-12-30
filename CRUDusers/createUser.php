<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Create Account</h1><hr>
        <form action="UsersBack\createUserPro.php" method="POST">
        <h2>User Information: </h2>
        <div class ="row">
            <div class="col-6">
                <label for="fname" class="form-label">Full Name:</label>
                <input type="text" name="name" id="fname" class="form-control form-control" placeholder="Enter Full Name" required/>
            </div>
            <div class="col-6">
                <label for="fic" class="form-label">IC number:</label>
                <input type="text" name="IC" id="fic" class="form-control form-control" placeholder="Enter IC Number"required/>
            </div>
        </div><br>    
            <script>
                var check = function() {
                  if (document.getElementById('password').value ==
                    document.getElementById('confirm_password').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = '  (matching)';
                  } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = '  (not matching)';
                  }
                }
            </script>
            <div class ="row">
                <div class="col-6">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control form-control" placeholder="Enter password"required>
                </div>
                <div class="col-6">
                    <label for="psw-repeat" class="form-label">Re-type Password:<span id='message'></span></label>  
                   <input type="password" id="confirm_password" placeholder="Retype Password" name="confirm_password" class="form-control form-control" onkeyup='check();' required/>  
                </div>
            </div><br>

            <div class="mb-3">
                <label for="faddr" class="form-label">Home Address:</label>
                <input type="text" name="faddr" id="faddr" class="form-control form-control" placeholder="Enter Home Address"required/>
            </div>

        <div class ="row">
            <div class="col-6">
                <label for="position" class="form-label">Position Assigned:</label>
                <select name="position" id="position" class="form-select form-select mb-3" aria-label="form-select example" onchange= "assignHiddenInput(this)" required/>
                    <option value="" selected>Choose a position</option>
                    <option value="Admin">Admin</option>
                    <option value="PIC">PIC</option> 
                    <option value="Assistant Computer Technician">Assistant Computer Technician</option> 
                    <option value="Assistant Engineer">Assistant Engineer</option>
                </select>
            </div>
                
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
                <script>
                        $("#position").change(function() {
                      if ($(this).val() == "PIC") {
                        $('#PIC').show();
                        $('#roomName').attr('required', '');
                        $('#roomName').attr('data-error', 'This field is required.');
                      } else {
                        $('#PIC').hide();
                        $('#roomName').removeAttr('required');
                        $('#roomName').removeAttr('data-error');
                      }
                    });
                    $("#position").trigger("change");
                </script>

                <div class="col-6">
                <div class="form-label" id="PIC">
                <label for="roomName" class="form-label">Room Managed:</label>
                <input type="text" name="room" id="roomName" class="form-control form-control" placeholder="Enter Room Name">
                </div>
                </div>
        </div><br>


           <label for="upload" class="form-label">Upload Profile Picture:</label><br>
           <input type="file" name="file" id="file" />
           <br />
           <span id="uploaded_image"></span>
            <!--<form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">  
            </form><br>-->
            <script>
                $(document).ready(function(){
                 $(document).on('change', '#file', function(){
                  var name = document.getElementById("file").files[0].name;
                  var form_data = new FormData();
                  var ext = name.split('.').pop().toLowerCase();
                  if(jQuery.inArray(ext, ['pdf','gif','png','jpg','jpeg']) == -1) 
                  {
                   alert("Invalid Image File");
                  }
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("file").files[0]);
                  var f = document.getElementById("file").files[0];
                  var fsize = f.size||f.fileSize;
                  if(fsize > 2000000)
                  {
                   alert("Image File Size is very big");
                  }
                  else
                  {
                   form_data.append("file", document.getElementById('file').files[0]);
                   $.ajax({
                    url:"upload.php",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                    },   
                    success:function(data)
                    {
                     $('#uploaded_image').html(data);
                    }
                   });
                  }
                 });
                });
        </script>
            <div class="row">
                <h2><br>User Contact Information:</h2>
              <div class="col-6">
                <label for="fcontactnum" class="form-label">Contact Number:</label>
                <input type="text" name="fcontactnum" id="fcontactnum" class="form-control form-control" placeholder="Enter contact number"required/>
              </div>
              <div class="col-6">
                <label for="femail" class="form-label">Email Address:</label>
                <input type="text" name="femail" id="femail" class="form-control form-control" placeholder="Enter email address">
              </div>
            </div>
            <div class="row">
                <h2><br>Admin Section:</h2>
                <div class="col-6">
                <label for="admin" class="form-label">Admin In Charge:</label>
                <input type="text" name="fAname" id="fAname" class="form-control form-control" placeholder="Enter Admin Name">
                </div>
                <div class="col-6">
                <label for="RegisteredDate" class="form-label">Registered Date:</label><br>
                <input type="date" name="rdate" id="rdate" value="">
                </div>
            </div><br><br>
            <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Submit"/>
            <input type="reset" name="clear" value="Clear"class="btn btn-warning">
        </form>
    </div>
</body>
</html>

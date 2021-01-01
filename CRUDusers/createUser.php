<?php
// define variables and set to empty values
    $username = "";
    $IC = "";
    $password = "";
    $addr = "";
    $positionBI = "";
    $contact = "";
    $room = "";
    $email= "";

    $usernameErr = "";
    $ICErr = "";
    $passwordErr = "";
    $addrErr = "";
    $positionBIErr = "";
    $contactErr = "";
    $roomErr = "";
    $emailErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["name"])) {
    $usernameErr = "Name is required";
  } else {
    $username = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
      $usernameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["femail"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["femail"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["fcontactnum"])) {
    $contactErr = "Contact number is required";
  } else {
    $contact = test_input($_POST["fcontactnum"]);
    // check if contact is well-formed
    if (!preg_match('/^[0-9]{3}-[0-9]{7,8}$/',$contact)) {
      $contactErr = "Correct Format in Digit: XXX-XXXXXXXX";
    }
  }

  if (empty($_POST["ic"])) {
    $ICErr = "IC number is required";
  } else {
    $IC = test_input($_POST["ic"]);
    // check if contact is well-formed
    if (!preg_match('/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/',$IC)) {
      $ICErr = "Correct Format in Digit: XXXXXX-XX-XXXX";
    }
  }

   if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if contact is well-formed
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
      $passwordErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }
  }

} 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
/* The message box is shown when the user clicks on the password field */
#error {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#error p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Create Account</h1><hr>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
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
                    <input type="password" name="password" id="password" class="form-control form-control" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
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
                <select name="position" id="position" class="form-select form-select mb-3" aria-label="form-select example" required/>
                    <option value="" selected>Choose a position</option>
                    <option value="Admin">Admin</option>
                    <option value="PIC Of Room">PIC Of Room</option> 
                    <option value="Assistant Computer Technician">Assistant Computer Technician</option> 
                    <option value="Assistant Engineer">Assistant Engineer</option>
                </select>
            </div>
                
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
                <script>
                    $("#position").change(function() 
                    {
                      if ($(this).val() == "PIC Of Room") 
                      {
                        $('#PIC').show();
                        $('#roomName').attr('required', '');
                        $('#roomName').attr('data-error', 'This field is required.');
                      } else 
                      {
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
                <input type="text" name="fcontactnum" id="fcontactnum" class="form-control" placeholder="Enter contact number" pattern="^(\+?6?01)[0|1|2|3|4|6|7|8|9]-*[0-9]{7,8}$" required/>
              </div>
              <div class="col-6">
                <label for="femail" class="form-label">Email Address:</label>
                <input type="text" name="femail" id="femail" class="form-control form-control" placeholder="Enter email address">
              </div>
            </div>
            
            <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Submit"/>
            <input type="reset" name="clear" value="Clear"class="btn btn-warning">
        </form>
    </div>

    <div id="error">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
        
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("error").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("error").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

</body>
</html>

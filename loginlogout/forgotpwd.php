<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #0902d6;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 15%;
  /*border-radius: 50%;*/
}

.container {
  padding: 16px;
}

span.pwd {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.pwd {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h1 style="text-align:center">Check IC</h1>

<form action="forgotpwdprocess.php" method="POST">
  <div class="imgcontainer">
    <img src="../img/kvpjb.jpg" alt="KVPJB" class="avatar">
  </div>

  <div class="container">
    <div class="form-group">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter IC" id="fic" name="ic" required>
    </div>
    <button type="submit">Check</button>
    <label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button onclick = "document.location='login.php'" type="button" class="cancelbtn">Cancel</button>
    
  </div>
</form>

</body>
</html>

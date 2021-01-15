<!DOCTYPE html>
<html>
<style>

.main-section{
    background-size:100% 100%;
    margin: 0px;
    width: 100%;
}
.img-container {
    margin-left:-1%;
    margin-top:-1%;
    float: left;
}
.user-login-header,.login-image-main{
    margin-top: 15px;
}
.user-login-header h1{
    font-size: 45px;
    color:#fff;
}

.user-login-header p,.last-part p{
    color:#0902d6;
}
.user-login-header span{
    color:#fff;
    font-weight: 600;
}
.login-image-main{
    padding: 30px;
    background-color:#fff;
    border-radius:5px;
    box-shadow: 0 0 5px 0 #fff;
}
.user-image-section img{
    height:250px;
    width:250px;
    border: 50%;
}
.user-login-box,.last-part{
    padding:20px;
}
.user-login-box a,.user-login-box a:hover{
    background-color: #0902d6;
    border:1px solid #0902d6;
    width: 100%;
    color:#fff;
    font-weight:600;
}
.button{
    background-color: #0902d6;
    border:1px solid #0902d6;
    width: 100%;
    color:#fff;
    font-weight:600;
    border-radius:5px;
    height: 35px;
}
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f7f011;
  border:1px solid #f7f011;
  /*float: left;*/
  font-weight:600;
  border-radius:5px;
  height: 40px;
}
.last-part a{
    text-decoration: none;
    color:#0902d6;
}
  </style>
<body>
    
<head>
  <title>Forget Password</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset = "UTF-8" />

</head>
<body>
  
  <form action="forgotpwdprocess.php" method="post">
    <div class="container main-section">
          <h1 style="text-align:center">Check IC</h1>
    </div>

    <div class="row">
      <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2 login-image-main text-center">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 user-image-section">
            <img src="../img/kvpjb.png">

              <div class="col-md-12 col-sm-12 col-xs-12 user-login-box">

                  <div class="form-group">
                    <div class="img-container"> <!-- Block parent element -->
                      <label for="ic"><b>Username:</b></label>
                    </div>

                    <input type="text" class="form-control" placeholder="Enter IC" id="fid" name="ic">
                  </div>
        
                    <button type="submit" class="button">Check</button><br>
                     <!-- Block parent element -->
                    <br><button onclick = "document.location='login.php'" type="button" class="cancelbtn">Cancel</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </form>

</body>
</html>

<!-- 
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
      <img src="../img/kvpjb.png" alt="KVPJB" class="avatar">
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
 -->
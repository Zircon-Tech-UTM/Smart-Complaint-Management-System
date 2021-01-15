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
.last-part a{
    text-decoration: none;
    color:#0902d6;
}
  </style>
<body>
    
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset = "UTF-8" />

</head>
<body>
  
  <form action="loginprocess.php" method="post" id="frmLogin">
    <div class="text-danger"><?php if(isset($message)){echo $message;} ?></div>

    <div class="container main-section">
          <h1 style="text-align:center">Login Form</h1>
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

                    <input type="text" class="form-control" placeholder="Enter IC" id="fid" name="ic" value="<?php if(isset($_COOKIE["member_ic"])) {echo $_COOKIE["member_ic"];}?>" required/>
                  </div>
                  <script>
                    function myFunction() 
                {
                  var x = document.getElementById("pwd");
                  if (x.type === "password") 
                  {
                    x.type = "text";
                  } 
                  else 
                  {
                    x.type = "password";
                  }
                }
                  </script>

                  <div class="form-group">
                    <div class="img-container"> <!-- Block parent element -->
                      <label for="pwd"><b>Password:</b></label>
                    </div>

                    <input type="Password" class="form-control" placeholder="Password" name="pwd" id="pwd" value="<?php if(isset($_COOKIE["member_pwd"])) {echo $_COOKIE["member_pwd"];}?>" required/><br>
                    <div class="img-container"> <!-- Block parent element -->
                    <input type="checkbox" onclick="myFunction()"> Show Password
                    </div>
                  </div><br>

                    <input type="checkbox" checked="checked" name="remember" id="remember"<?php if(isset($_COOKIE["member_ic"])) { ?> checked <?php }?>/>
                    
                    <label for="remember-me"> Remember me</label>
                  <br><br>
          
                  <button type="submit" name="login" value="Login"class="button">Login</a>
              </div>

            <div class="col-md-12 col-sm-12 col-xs-12 last-part">
              <p><a href="forgotpwd.php"> Forget Password?</a></p>
            </div>
              
          </div>
        </div>
      </div>
    </div>
  </form>

</body>
</html>